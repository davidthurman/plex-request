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

class RequestController extends Controller
{

    public function admin() {

        $errors = serverError::all();
        $requests = PlexRequest::all();
        $users = User::all();
        $activepage = 'admin';

        return view('adminpanel', [
            'errors' => $errors,
            'requests' => $requests,
            'users' => $users,
            'activepage' => $activepage
        ]);

    }

    public function showPendingRequests() {

        $currentUserID = Auth::user()->id;

        $activepage = 'userrequests';
        $activetab = 'pending';

        $requests = PlexRequest::where('userid', '=', $currentUserID)
            ->where('status', '=', 0)->get();
        
        return view('userrequests', compact('requests', 'activepage', 'activetab'));

    }

    public function showFilledRequests() {

        $currentUserID = Auth::user()->id;

        $activepage = 'userrequests';
        $activetab = 'filled';

        $requests = PlexRequest::where('userid', '=', $currentUserID)
            ->where('status', '=', 1)->get();

        return view('userrequests', compact('requests', 'activepage', 'activetab'));

    }

    public function showDeclinedRequests() {

        $currentUserID = Auth::user()->id;

        $activepage = 'userrequests';
        $activetab = 'declined';

        $requests = PlexRequest::where('userid', '=', $currentUserID)
            ->where('status', '=', 2)->get();

        return view('userrequests', compact('requests', 'activepage', 'activetab'));

    }

    public function searchPage() {

        $activepage = 'search';

        return view('searchpage', [
            'activepage' => $activepage
        ]);
    }

    public function searchRequest(Request $request) {

        $activepage = 'search';

        $data = $request->all();

        $title = $data['title'];

        $type = $data['mediatype'];

        $title = rawurlencode($title);

        $key = env('TMDB_KEY');

        $url = "http://api.themoviedb.org/3/search/".$type."?api_key=".$key."&query=".$title."&include_adult=false&language=en";

        $json = json_decode(file_get_contents($url), true);

        $query = Input::get('title');

        if (array_key_exists('total_results', $json) && $json['total_results'] == 0) {

            return view('searchresults', [
                'json' => $json,
                'activepage' => $activepage,
                'type' => $type,
                'query' => $query
            ])->with(\Session::flash('failure', 'No results matched your query.'));

        } else {

            return view('searchresults', [
                'json' => $json,
                'activepage' => $activepage,
                'type' => $type,
                'query' => $query
            ]);

        }

    }

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

                return redirect()->route('pendingrequests')->with(\Session::flash('success', 'Your request was received.'));
            } else {
                return redirect()->route('pendingrequests')->with(\Session::flash('failure', 'There was a problem. Your request was not submitted.'));
            }

        } else {

            return redirect()->route('search')->withInput()->with(\Session::flash('failure', 'A request has already been submitted for that title.'));
        }

    }

    public function fill($id) {
        $request = PlexRequest::findOrFail($id);
        $request->status = 1;
        $request->save();
        if ($request->status == 1) {
            return redirect()->back()->with(\Session::flash('success', 'Request has been marked as filled.'));
        } else {
            return redirect()->back()->with(\Session::flash('failure', 'There was a problem. The request was not marked filled.'));
        }
    }

    public function decline($id) {
        $request = PlexRequest::findOrFail($id);
        $request->status = 2;
        $request->save();
        if ($request->status == 2) {
            return redirect()->back()->with(\Session::flash('success', 'Request has been marked as declined.'));
        } else {
            return redirect()->back()->with(\Session::flash('failure', 'There was a problem. The request was not marked declined.'));
        }
    }

}
