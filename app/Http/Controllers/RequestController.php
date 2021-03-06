<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\serverError;
use App\PlexRequest;
use Validator;
use Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use Mail;
use Illuminate\Support\Facades\Storage;

class RequestController extends BaseController
{

    /**
     * Display the user requests view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function displayRequests() {
        return view('requests.requests');
    }

    /**
     * Fetch the user's pending requests
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pendingRequests() {
        $requests = PlexRequest::where('userid', '=', Auth::user()->id)
            ->where('status', '=', 0)->get();
        
        return view('requests.partials.request', compact('requests'));
    }

    /**
     * Fetch the user's filled requests
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function filledRequests() {
        $requests = PlexRequest::where('userid', '=', Auth::user()->id)
            ->where('status', '=', 1)->get();

        return view('requests.partials.request', compact('requests'));
    }

    /**
     * Fetch the user's declined requests
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function declinedRequests() {
        $requests = PlexRequest::where('userid', '=', Auth::user()->id)
            ->where('status', '=', 2)->get();

        return view('requests.partials.request', compact('requests'));
    }

    /**
     * Display the view to search/submit new requests
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchPage() {
        return view('requests.search');
    }

    /**
     *
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchRequest(Request $request) {

        $data = $request->all();
        $title = $data['title'];
        $type = $data['mediatype'];
        $title = rawurlencode($title);
        $key = env('TMDB_KEY');
        $url = "http://api.themoviedb.org/3/search/".$type."?api_key=".$key."&query=".$title."&include_adult=false&language=en";
        $json = json_decode(file_get_contents($url), true);
        $query = Input::get('title');

        if (array_key_exists('total_results', $json) && $json['total_results'] == 0) {

            return view('requests.results', [
                'json' => $json,
                'type' => $type,
                'query' => $query
            ])->with(\Session::flash('failure', 'No results matched your query.'));

        } else {

            return view('requests.results', [
                'json' => $json,
                'type' => $type,
                'query' => $query
            ]);

        }

    }

    /**
     * Submit a new media request
     * @param int $tmdbid
     * @param string $type
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit($tmdbid, $type) {

        $this->tmdbid = filter_var($tmdbid, FILTER_SANITIZE_STRING);

        $key = env('TMDB_KEY');

        $url = "http://api.themoviedb.org/3/".$type."/".$tmdbid."?api_key=".$key;

        $json = json_decode(file_get_contents($url), true);

        $request = PlexRequest::where('tmdbid', '=', $tmdbid)
            ->where('media_type', '=', $type)->first();

        if($request == null) {

            $newRequest = New PlexRequest;

            if($type == 'tv') {
                $newRequest->year = $json['first_air_date'];
                $newRequest->title = $json['original_name'];
                $newRequest->media_type = 'tv';
            } elseif($type == 'movie') {
                $newRequest->year = $json['release_date'];
                $newRequest->title = $json['original_title'];
                $newRequest->media_type = 'movie';
            }
            $newRequest->userid = Auth::user()->id;
            $newRequest->user = Auth::user()->name;
            $newRequest->tmdbid = $tmdbid;
            $newRequest->status = 0;

            //grab the movie poster and save it locally
            $poster = 'http://image.tmdb.org/t/p/w185/'.$json['poster_path'];
            $temp_image = file_get_contents($poster);
            if($type == 'movie') {
                Storage::disk('public')->put('/posters/movie/' . $tmdbid . '.jpg', $temp_image);
                $newRequest->poster_path = '/posters/movie/'.$tmdbid.'.jpg';
            }
            elseif($type == 'tv') {
                Storage::disk('public')->put('/posters/tv/' . $tmdbid . '.jpg', $temp_image);
                $newRequest->poster_path = '/posters/tv/'.$tmdbid.'.jpg';
            }

            if($newRequest->save()) {

                $to = env('ADMIN_EMAIL');
                $subject = 'New Plex Request';
                $message = 'You\'ve received a new request for ' . $newRequest->title . '.';
                $headers = 'From: ' . 'admin@'.env('APP_URL') . "\r\n" .
                    'Reply-To: ' . 'admin@'.env('APP_URL') . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);

                return redirect()->route('displayrequests')->with(\Session::flash('success', 'Your request was received.'));
            } else {
                return redirect()->route('displayrequests')->with(\Session::flash('failure', 'There was a problem. Your request was not submitted.'));
            }

        } else {

            return redirect()->route('search')->withInput()->with(\Session::flash('failure', 'A request has already been submitted for that title.'));
        }

    }

    /**
     * Cancels a user's request if he is the owner
     * @param $id - ID of the asset to be cancelled.
     * @return string
     */
    public function cancel($id) {

        $request = PlexRequest::find($id);

        // Ensure the current user is the owner of the request to be cancelled.
        if ($request->userid == Auth::user()->id) {
            // Set status to cancelled.
            $request->status = 3;
            if($request->save()) {
                return json_encode(array("status"=>"success"));
            } else {
                return json_encode(array("status"=>"failure"));
            }
        } else {
            return 'You don\'t own this asset';
        }
    }

}