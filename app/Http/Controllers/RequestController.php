<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\serverError;

class RequestController extends Controller
{
    public function allRequests() {
      return view('allRequests');
    }

    public function userRequests() {
        return view('userRequests');
    }

    public function admin() {

        $errors = serverError::all();

        return view('adminPanel', compact('errors'));
    }
}
