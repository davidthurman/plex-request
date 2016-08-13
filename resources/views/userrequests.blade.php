@extends('layout.master')
@section('title')Your requests @stop
@section('content')
@if(!$requests->isEmpty())
    <div id="requestsdisplay">
        <div class="col-xs-12 col-md-10 col-md-offset-1 text-center">
            <h2>Your requests:</h2>
            <br>
            <ul class="nav nav-tabs">
                <li @if(isset($activetab) && $activetab == 'pending')class="active"@endif><a href="#" onclick="loadPending()">Pending</a></li>
                <li @if(isset($activetab) && $activetab == 'filled')class="active"@endif><a href="#" onclick="loadFilled()">Filled</a></li>
                <li @if(isset($activetab) && $activetab == 'declined')class="active"@endif><a href="#" onclick="loadDeclined()">Declined</a></li>
            </ul>
            <br>
            @foreach($requests as $request)
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @if($request->media_type == 'movie')
                                <a href="https://www.themoviedb.org/movie/{{ $request['tmdbid'] }}" target="new"><img src="{{ $request->getPosterPath($request['tmdbid'], $request->media_type) }}"></a>
                            @elseif($request->media_type == 'tv')
                                <a href="https://www.themoviedb.org/tv/{{ $request['tmdbid'] }}" target="new"><img src="{{ $request->getPosterPath($request['tmdbid'], $request->media_type) }}"></a>
                            @endif
                            <br><br>
                            <strong>Date requested:</strong> {{ date('M d, Y', strtotime($request['created_at'])) }}
                            @if(isset($activetab) && $activetab == 'filled')<br><strong>Date filled:</strong> {{ date('M d, Y', strtotime($request->updated_at)) }}@endif
                            @if(isset($activetab) && $activetab == 'declined')<br><strong>Date declined:</strong> {{ date('M d, Y', strtotime($request->updated_at)) }}@endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="col-xs-12 col-md-10 col-md-offset-1 text-center">
        <h2>Your requests:</h2>
        <br>
        <ul class="nav nav-tabs">
            <li @if(isset($activetab) && $activetab == 'pending')class="active"@endif><a href="#" onclick="loadPending()">Pending</a></li>
            <li @if(isset($activetab) && $activetab == 'filled')class="active"@endif><a href="#" onclick="loadFilled()">Filled</a></li>
            <li @if(isset($activetab) && $activetab == 'declined')class="active"@endif><a href="#" onclick="loadDeclined()">Declined</a></li>
        </ul>
        <br>
        <h2>You have no requests with that status.</h2>
    </div>
@endif
@stop
@section('jsadditions')
    <script type="text/javascript">

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("requestsdisplay").innerHTML = xhttp.responseText;
            }
        };

        function loadFilled() {
            xhttp.open("GET", "/filledrequests", true);
            xhttp.send();
        }

        function loadDeclined() {
            xhttp.open("GET", "/declinedrequests", true);
            xhttp.send();
        }

        function loadPending() {
            xhttp.open("GET", "/pendingrequests", true);
            xhttp.send();
        }

    </script>
@stop