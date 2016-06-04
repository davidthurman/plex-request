<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RequestController extends Controller
{
    public function allRequests() {
      return view('allRequests');
    }

    public function userRequests() {
        return view('userRequests');
    }
}
