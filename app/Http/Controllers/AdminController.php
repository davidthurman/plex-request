<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\serverError;
use App\PlexRequest;
use Illuminate\Foundation\Auth\User;

class AdminController extends BaseController
{
    public function dashboard() {

        $counts = array(
            'errors' => count(serverError::where('resolved', '=', 0)),
            'requests' => count(PlexRequest::all()),
            'users' => count(User::all()),
        );

        return view('admin.dashboard', [
            'counts' => $counts
        ]);

    }

    public function users() {
        $users = User::all();
        return view('admin.users', [
            'users' => $users
        ]);
    }

    public function errors() {
        $errors = serverError::where('resolved', '=', 0);
        return view('admin.errors', [
            'errors' => $errors
        ]);
    }

    public function pendingRequests() {
        $requests = PlexRequest::where('status', '=', 0)->get();
        return view('admin.requests', [
            'requests' => $requests,
        ]);
    }

    public function filledRequests() {
        $requests = PlexRequest::where('status', '=', 1)->get();
        return view('admin.requests', [
            'requests' => $requests,
        ]);
    }

    public function declinedRequests() {
        $requests = PlexRequest::where('status', '=', 2)->get();
        return view('admin.requests', [
            'requests' => $requests,
        ]);
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
