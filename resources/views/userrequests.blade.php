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
                    @if($request->media_type == 'movie')
                        <td><a href="https://www.themoviedb.org/movie/{{ $request['tmdbid'] }}" target="new">{{ $request->title }}</a></td>
                    @elseif($request->media_type == 'tv')
                        <td><a href="https://www.themoviedb.org/tv/{{ $request['tmdbid'] }}" target="new">{{ $request->title }}</a></td>
                    @endif
                    <td>{{ date('M d, Y', strtotime($request['created_at'])) }}</td>
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