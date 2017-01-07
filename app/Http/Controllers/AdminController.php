<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\serverError;
use App\PlexRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Auth\Access\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Input;

class AdminController extends BaseController
{
    /**
     * Retrieve pending requests and return with admin template that houses the partials.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard() {
        $plexrequests = PlexRequest::where('status', '=', 0)->get();
        return view('admin.dashboard', [
            'plexrequests' => $plexrequests
        ]);
    }

    /**
     * Retrieve requests with a pending status
     * @return View
     */
    public function pendingRequests() {
        $plexrequests = PlexRequest::where('status', '=', 0)->get();
        return view('admin.partials.requests', [
            'plexrequests' => $plexrequests
        ]);
    }

    /**
     * Retrieve requests with a filled status
     * @return View
     */
    public function filledRequests() {
        $plexrequests = PlexRequest::where('status', '=', 1)->get();
        return view('admin.partials.requests', [
            'plexrequests' => $plexrequests
        ]);
    }

    /**
     * Retrieve requests with a declined status
     * @return View
     */
    public function declinedRequests() {
        $plexrequests = PlexRequest::where('status', '=', 2)->get();
        return view('admin.partials.requests', [
            'plexrequests' => $plexrequests
        ]);
    }

    /**
     * Retrieve requests with a cancelled status
     * @return View
     */
    public function cancelledRequests() {
        $plexrequests = PlexRequest::where('status', '=', 3)->get();
        return view('admin.partials.requests', [
            'plexrequests' => $plexrequests
        ]);
    }

    /**
     * Retrieve all users and return admin.users view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function users() {
        $users = User::all();
        return view('admin.partials.users', [
            'users' => $users
        ]);
    }

    /**
     * Retrieve all unresolved errors and return admin.errors view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function errors() {
        $errors = serverError::where('resolved', '=', 0)->get();
        return view('admin.partials.errors', [
            'errors' => $errors
        ]);
    }

    /**
     * Change the status of a request to filled
     * @param int $id - The ID of the request being filled.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fill($id, Request $request) {
        $plexrequest = PlexRequest::findOrFail($id);
        $plexrequest->status = 1;
        $plexrequest->admin_response = $request->get('adminresponse');
        $plexrequest->save();
        if ($plexrequest->save()) {
            return redirect()->back()->with(\Session::flash('success', 'Request has been marked as filled.'));
        } else {
            return redirect()->back()->with(\Session::flash('failure', 'There was a problem. The request was not marked filled.'));
        }
    }

    /**
     * Change the status of a request to declined
     * @param int $id - The ID of the request being filled
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function decline($id, Request $request) {
        $plexrequest = PlexRequest::findOrFail($id);
        $plexrequest->status = 2;
        $plexrequest->admin_response = $request->get('adminresponse');
        $plexrequest->save();
        if ($plexrequest->save()) {
            return redirect()->back()->with(\Session::flash('success', 'Request has been marked as declined.'));
        } else {
            return redirect()->back()->with(\Session::flash('failure', 'There was a problem. The request was not marked declined.'));
        }
    }
}
