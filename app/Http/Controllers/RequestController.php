<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\serverError;
use App\PlexRequest;
use Validator;
use Auth;
use Input;
use App\User;

class RequestController extends Controller
{
    public function allRequests() {

        $requests = PlexRequest::all();
        return view('allRequests', compact('requests'));

    }

    public function userRequests() {

        $currentUserID = Auth::user()->id;
        $requests = PlexRequest::where('userid', '=', $currentUserID)->get();
        return view('userRequests', compact('requests'));

    }

    public function admin() {

        $errors = serverError::all();
        $requests = PlexRequest::all();
        $users = User::all();
        return view('adminPanel', compact('errors', 'requests', 'users'));

    }

    public function searchRequest(Request $request, Response $response) {

        $data = $request->all();

        $title = $data['title'];

        $title = rawurlencode($title);

        $url = "http://www.omdbapi.com/?s=" . $title . "&r=json";

        $json = json_decode(file_get_contents($url), true);

        $movieIDs = array();
        
        foreach($json['Search'] as $movie) {

            $movieIDs[] = $movie['imdbID'];

        }

        foreach($movieIDs as $imdbID) {

            $needle = '{{imdbID}}';

            $haystack = 'http://img.omdbapi.com/?i={{imdbID}}&apikey=' . env('OMDB_KEY');

            $links[] = str_replace($needle, $imdbID, $haystack);

        }
        

//        $jsonWithImages = array_merge($json, $links);
//
//        return $jsonWithImages;

        return view('searchResults', compact('links'));

    }

    public function submit(Request $request) {

        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'title' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with(\Session::flash('failure', 'There was a problem. Your request was not submitted.'));
        } else {

            $newRequest = New PlexRequest;

            $newRequest->year = $data['year'];
            $newRequest->title = $data['title'];
            $newRequest->userid = Auth::user()->id;
            $newRequest->save();

            return redirect()->route('userrequests')->with(\Session::flash('success', 'Your request was received.'));;

        }

    }

    public function destroy(Request $request) {
        $data = $request->all();
        return $data['id'];
        return 'deleted';

    }
}
