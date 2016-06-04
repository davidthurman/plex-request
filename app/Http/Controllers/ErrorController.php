<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\serverError;
use Validator;
use Auth;

class ErrorController extends Controller
{
    public function reportError() {
        return view('reportError');
    }

    public function submitError(Request $request, Response $response) {

        $data = $request->all();

        $error = new serverError;

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'date' => 'required',
            'description' => 'required|min:10|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with(\Session::flash('failure', 'There was an error submitting your... error. When it rains it pours, eh?'));
        }

        $error->userid = Auth::user()->id;
        $error->name = $data['name'];
        $error->date = $data['date'];
        $error->description = $data['description'];

        $error->save();

        return redirect()->back()
            ->with(\Session::flash('success', 'Error has been submitted and I will look into it.'));
    }
}
