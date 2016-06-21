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

    public function userRequests() {

        $currentUserID = Auth::user()->id;
        $requests = PlexRequest::where('userid', '=', $currentUserID)->get();
        return view('userrequests', compact('requests'));

    }

    public function admin() {

        $errors = serverError::all();
        $requests = PlexRequest::all();
        $users = User::all();
        return view('adminpanel', compact('errors', 'requests', 'users'));

    }

    public function searchPage() {
        return view('searchpage');
    }

    public function searchRequest(Request $request, Response $response) {

        $data = $request->all();

        $title = $data['title'];

        $title = rawurlencode($title);

        $url = "http://www.omdbapi.com/?s=" . $title . "&r=json";

        $json = json_decode(file_get_contents($url), true);

        return view('searchresults', compact('json'));

    }

    public function submit($imdbID) {

        $url = "http://www.omdbapi.com/?i=" . $imdbID . "&r=json";

        $omdbJson = json_decode(file_get_contents($url), true);

        $newRequest = New PlexRequest;

        $newRequest->year = $omdbJson['Year'];
        $newRequest->title = $omdbJson['Title'];
        $newRequest->userid = Auth::user()->id;
        $newRequest->user = Auth::user()->name;
        if($newRequest->save()) {
            return redirect()->route('userrequests')->with(\Session::flash('success', 'Your request was received.'));
        } else {
            return redirect()->back()->with(\Session::flash('failure', 'There was a problem. Your request was not submitted.'));
        }

    }

    public function destroy($id) {
        $request = PlexRequest::findOrFail($id);
        if ($request->delete()) {
            return redirect()->back()->with(\Session::flash('success', 'Request has been deleted.'));
        } else {
            return redirect()->back()->with(\Session::flash('failure', 'There was a problem. The request was not deleted.'));
        }
    }

    public function editadmin(Request $request) {

        $inputs = $request->input('admincheckbox');

        foreach ($inputs as $uid => $value) {
            $user = User::find($uid);
            $user->admin= $value;
            $user->save();
        }

        return redirect()->back()->with(\Session::flash('success', 'Changes saved.'));
    }
}
