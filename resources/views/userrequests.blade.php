@extends('partials.master')

@section('content')
    @if (Auth::check())
    <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
        <h2>Your unfulfilled requests:</h2>
        <table class="table table-hover table-bordered">
            <tr class="active">
                <td>Title:</td>
                <td>Requested on:</td>
            </tr>
            @foreach($requests as $request)
                <tr>
                    <td><a href="http://imdb.com/title/{{ $request['imdbid'] }}" target="new">{{ $request->title }}</a></td>
                    <td>{{ $request['created_at']}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    @else
    <div class="col-xs-12 col-md-6 col-md-offset-3 text-center">
        <h2>You shouldn't be seeing this, someone messed up.</h2>
    </div>
    @endif
@stop