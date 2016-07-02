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
use Mail;
use Carbon\Carbon;

class RequestController extends Controller
{

    public function admin() {

        $errors = serverError::all();
        $requests = PlexRequest::all();
        $users = User::all();
        return view('adminpanel', compact('errors', 'requests', 'users'));

    }



    public function userRequests() {

        $currentUserID = Auth::user()->id;

        $requests = PlexRequest::where('userid', '=', $currentUserID)->get();
        
        return view('userrequests', compact('requests'));

    }

    public function searchPage() {
        return view('searchpage');
    }

    public function searchRequest(Request $request) {

        $data = $request->all();

        $title = $data['title'];

        $title = rawurlencode($title);

        $url = "http://www.omdbapi.com/?s=" . $title . "&r=json";

        $json = json_decode(file_get_contents($url), true);

        if(array_key_exists('Error', $json)) {

            return redirect()->route('search')->with(\Session::flash('failure', 'Your search returned no results.'));

        } else {

            return view('searchresults', compact('json'));

        }


    }

    public function submit($imdbID) {

        $this->imdbID = filter_var($imdbID, FILTER_SANITIZE_STRING);

        $url = "http://www.omdbapi.com/?i=" . $imdbID . "&r=json";

        $omdbJson = json_decode(file_get_contents($url), true);

        $request = PlexRequest::where('imdbid', '=', $imdbID)->first();

        if($request == null) {

            $newRequest = New PlexRequest;

            $newRequest->year = $omdbJson['Year'];
            $newRequest->title = $omdbJson['Title'];
            $newRequest->userid = Auth::user()->id;
            $newRequest->user = Auth::user()->name;
            $newRequest->imdbid = $imdbID;
            if($newRequest->save()) {

                $to = env('ADMIN_EMAIL');
                $subject = 'New Plex Request';
                $message = 'You\'ve received a new request for ' . $newRequest->title . '.';
                $headers = 'From: admin@plexrequest.net' . "\r\n" .
                    'Reply-To: admin@plexrequest.net' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);

                return redirect()->route('userrequests')->with(\Session::flash('success', 'Your request was received.'));
            } else {
                return redirect()->route('userrequests')->with(\Session::flash('failure', 'There was a problem. Your request was not submitted.'));
            }

        } else {

            return redirect()->route('search')->with(\Session::flash('failure', 'There is already a pending request for that title.'));
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

}
