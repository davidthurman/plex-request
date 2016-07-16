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

        $activepage = 'reporterror';

        return view('reporterror', compact('activepage'));
    }

    public function submitError(Request $request, Response $response) {

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

        $error->save();

        return redirect()->back()
            ->with(\Session::flash('success', 'Error has been submitted and I\'ll look into it.'));
    }

    public function destroy($id) {

        $error = serverError::findOrFail($id);

        if ($error->delete()) {
            return redirect()->back()->with(\Session::flash('success', 'Error has been deleted.'));
        } else {
            return redirect()->back()->with(\Session::flash('failure', 'There was a problem. The error was not deleted.'));
        }
    }
}
