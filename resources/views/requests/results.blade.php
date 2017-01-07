@extends('master')
@section('title')Search results @stop

@section('content')
<div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
    <form class="form-inline" style="margin-bottom: 100px;" role="form" method="POST" action="{{ route('searchrequest') }}">
        {{ csrf_field() }}
        <h2>Search again:</h2>
        <select name="mediatype" class="form-control">
            @if($type == 'movie')
                <option value="movie" selected>Movie</option>
                <option value="tv">TV Show</option>
            @elseif($type == 'tv')
                <option value="movie">Movie</option>
                <option value="tv" selected>TV Show</option>
            @endif
        </select>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title" @if(isset($query))value="{{ $query }}" @endif required>
        <button type="submit" id="submit" class="btn btn-plex">Search</button>
    </form>
</div>
<div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
    <table class="table table-bordered table-hover">
        @if($type == 'movie')
            @foreach($json['results'] as $movie)
                @if($movie['poster_path'] != null && $movie['overview'] != null)
                <div class="panel panel-default resultbox">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="https://www.themoviedb.org/movie/{{ $movie['id'] }}" target="_blank">
                                    <img src="http://image.tmdb.org/t/p/w185/{{ $movie['poster_path'] }}">
                                </a>
                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-8">
                                <a href="https://www.themoviedb.org/movie/{{ $movie['id'] }}" target="_blank"><h3>{{ $movie['title'] . " (" . date('Y', strtotime($movie['release_date'])) . ")"}}</h3></a><br>
                                <p>{{ str_limit($movie['overview'], 300) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                            </div>
                            <div class="col-xs-8">
                                <a href="https://www.themoviedb.org/movie/{{ $movie['id'] }}" target="_blank">
                                    <button class="btn btn-default">More</button>
                                </a>
                                <a class="searchrequestsubmit" href="{{ route('submitrequest', ['tmdbid' => $movie['id'], 'type' => $type]) }}">
                                    <button class="btn btn-plex">Submit</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                @endif
            @endforeach
        @elseif($type == 'tv')
            @foreach($json['results'] as $tvshow)
                @if($tvshow['poster_path'] != null && $tvshow['overview'] != null)
                    <div class="panel panel-default resultbox">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="https://www.themoviedb.org/tv/{{ $tvshow['id'] }}" target="_blank">
                                        <img src="http://image.tmdb.org/t/p/w185/{{ $tvshow['poster_path'] }}">
                                    </a>
                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-8">
                                    <a href="https://www.themoviedb.org/tv/{{ $tvshow['id'] }}" target="_blank">
                                        <h3>{{ $tvshow['name'] . " - " . date('Y', strtotime($tvshow['first_air_date'])) }}</h3>
                                    </a>
                                    <br>
                                    <span class="resultsummary">{{ str_limit($tvshow['overview'], 300) }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                </div>
                                <div class="col-xs-8">
                                    <a href="https://www.themoviedb.org/tv/{{ $tvshow['id'] }}" target="_blank">
                                        <button class="btn btn-default">More</button>
                                    </a>
                                    <a class="searchrequestsubmit" href="{{ route('submitrequest', ['tmdbid' => $tvshow['id'], 'type' => $type]) }}">
                                        <button class="btn btn-plex">Submit</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                @endif
            @endforeach
        @endif
    </table>
</div>
@stop