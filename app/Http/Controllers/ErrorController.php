<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use App\serverError;
use League\Flysystem\Exception;
use Mockery\Exception\RuntimeException;
use Validator;
use Auth;

class ErrorController extends BaseController
{
    /**
     * Display the error form to the user.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reportError() {
        return view('errors.report');
    }

    /**
     * Submit an error with the server for review.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitError(Request $request) {

        $data = $request->all();

        $error = new serverError;

        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'description' => 'required|min:10|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with(\Session::flash('failure', 'Both fields are required.'));
        }

        $error->userid = Auth::user()->id;
        $error->name = Auth::user()->name;
        $error->date = $data['date'];
        $error->description = $data['description'];
        $error->resolved = 0;

        if($error->save()) {
            return redirect()->back()
                ->with(\Session::flash('success', 'Error has been submitted and I\'ll look into it.'));
        } else {
            new RuntimeException("Error failed to submit.");
            return redirect()->back()
                ->with(\Session::flash('failure', 'There was a problem. The error was not submitted for review.'));
        }
    }

    /**
     * Mark an error as resolved by changing resolved column to 1.
     * @param int $id - The ID of the error to be marked resolved.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resolve($id) {

        $error = serverError::findOrFail($id);
        $error->resolved = 1;
        $error->save();

        if ($error->save()) {
            return redirect()->back()->with(\Session::flash('success', 'Error has been marked resolved.'));
        } else {
            return redirect()->back()->with(\Session::flash('failure', 'There was a problem. The error was not marked resolved.'));
        }
    }
}
