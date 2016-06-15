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

        return view('searchResults', compact('json'));

    }

    public function submit(Request $request, $movie) {

        return $movie;

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
            $newRequest->user = Auth::user()->name;
            $newRequest->save();

            return redirect()->route('userrequests')->with(\Session::flash('success', 'Your request was received.'));

        }

    }

    public function destroy(Request $request) {
        $data = $request->all();
        //$id = PlexRequest::findOrFail($data['id']);
        //$id->delete();
        return redirect()->route('admin')->with(\Session::flash('success', 'Request was removed.'));
    }
}
