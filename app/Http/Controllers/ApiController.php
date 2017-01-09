<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

    public function search($type, $query) {
        $key = env('TMDB_KEY');
        $url = "http://api.themoviedb.org/3/search/".$type."?api_key=".$key."&query=".rawurlencode($query)."&include_adult=false&language=en";
        $json = json_decode(file_get_contents($url), true);
        return $json;
    }

    public function post(Request $request) {

        $validator = Validator::make($request->all(), [
            'year' => 'required|integer',
            'title' => 'required|string',
            'type' => 'required|string',
            'userid' => 'required|integer',
            'tmbdid' => 'required|integer',
            'media_type' => 'required|string',
            'poster_path' => 'required|string'
        ]);

        if ($validator->fails()) {
            return 'There was a problem with your submission.';
        }

        return 'everything went through';

    }

}
