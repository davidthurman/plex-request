@extends('layout.master')
@section('title')Search results @stop

@section('content')
<div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
    <form class="form-inline" style="margin-bottom: 100px;" role="form" method="POST" action="{{ route('searchrequest') }}">
        {{ csrf_field() }}
        <h2>Search again:</h2>
        <select name="mediatype" class="form-control">
            <option value="movie">Movie</option>
            <option value="tv">TV Show</option>
        </select>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
        <button type="submit" id="submit" class="btn btn-plex">Search</button>
    </form>
</div>
<div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
    <h2>Search results:</h2>
    <br>
    <table class="table table-bordered table-hover">
        @if($type == 'movie')
            <tr class="active">
                <td>Release:</td>
                <td>Title:</td>
                <td>Submit:</td>
            </tr>
            @foreach($json['results'] as $movie)
                <tr>
                    <td>{{ $movie['release_date'] }}</td>
                    <td><a href="https://www.themoviedb.org/movie/{{ $movie['id'] }}">{{ $movie['title'] }}</a></td>
                    <td class="text-center"><a href="{{ route('submitrequest', ['tmdbid' => $movie['id'], 'type' => $type]) }}"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></td>
                </tr>
            @endforeach
        @elseif($type == 'tv')
            <tr class="active">
                <td>First aired:</td>
                <td>Title:</td>
                <td>Submit:</td>
            </tr>
            @foreach($json['results'] as $tvshow)
                <tr>
                    <td>{{ $tvshow['first_air_date'] }}</td>
                    <td><a href="https://www.themoviedb.org/tv/{{ $tvshow['id'] }}">{{ $tvshow['original_name'] }}</a></td>
                    <td class="text-center"><a href="{{ route('submitrequest', ['tmdbid' => $tvshow['id'], 'type' => $type]) }}"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></td>
                </tr>
            @endforeach
        @endif
    </table>
</div>
@stop