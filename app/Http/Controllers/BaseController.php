<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class BaseController extends Controller
{
    public function __construct() {

        $path = Route::getCurrentRoute()->getPath();

        // Make path available in all views
        View::share('path', $path);

    }
}