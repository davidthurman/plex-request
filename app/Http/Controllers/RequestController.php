<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RequestController extends Controller
{
    public function home() {
      return view('home');
    }
}
