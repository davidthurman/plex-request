@extends('layout.master')
@section('title')Your requests @stop
@section('content')
@if(!$requests->isEmpty())
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
    <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
        <h2>You haven't submitted any requests yet.</h2>
    </div>
@endif
@stop