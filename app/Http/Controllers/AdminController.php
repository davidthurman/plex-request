<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\serverError;
use App\PlexRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Auth\Access\Response;
use Illuminate\View\View;

class AdminController extends BaseController
{
    /**
     * Get counts for errors, requests, and users, then return admin.dashboard view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * Retrieve all users and return admin.users view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function users() {
        $users = User::all();
        return view('admin.users', [
            'users' => $users
        ]);
    }

    /**
     * Retrieve all unresolved errors and return admin.errors view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function errors() {
        $errors = serverError::where('resolved', '=', 0)->get();
        return view('admin.errors', [
            'errors' => $errors
        ]);
    }

    /**
     * Retrieve requests with a pending status and display the view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function displayRequests() {
        $requests = PlexRequest::where('status', '=', 0)->get();
        return view('admin.requests', [
            'requests' => $requests,
        ]);
    }

    /**
     * Retrieve requests with a pending status
     * @return mixed
     */
    public function pendingRequests() {
        $requests = PlexRequest::where('status', '=', 0)->get();
        return $requests;
    }

    /**
     * Retrieve requests with a filled status
     * @return mixed
     */
    public function filledRequests() {
        $requests = PlexRequest::where('status', '=', 1)->get();
        return $requests;
    }

    /**
     * Retrieve requests with a declined status
     * @return mixed
     */
    public function declinedRequests() {
        $requests = PlexRequest::where('status', '=', 2)->get();
        return $requests;
    }

    /**
     * Change the status of a request to filled
     * @param int $id - The ID of the request being filled.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fill($id) {
        $request = PlexRequest::findOrFail($id);
        $request->status = 1;
        $request->save();
        if ($request->save()) {
            return redirect()->back()->with(\Session::flash('success', 'Request has been marked as filled.'));
        } else {
            return redirect()->back()->with(\Session::flash('failure', 'There was a problem. The request was not marked filled.'));
        }
    }

    /**
     * Change the status of a request to declined
     * @param int $id - The ID of the request being filled
     * @return \Illuminate\Http\RedirectResponse
     */
    public function decline($id) {
        $request = PlexRequest::findOrFail($id);
        $request->status = 2;
        $request->save();
        if ($request->save()) {
            return redirect()->back()->with(\Session::flash('success', 'Request has been marked as declined.'));
        } else {
            return redirect()->back()->with(\Session::flash('failure', 'There was a problem. The request was not marked declined.'));
        }
    }
}
