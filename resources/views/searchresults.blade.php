@extends('layout.master')
@section('title')Search results @stop

@section('content')
<div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
    <form class="form-inline" style="margin-bottom: 100px;" role="form" method="POST" action="{{ route('searchrequest') }}">
        {{ csrf_field() }}
        <h2>Search again:</h2>
        <br>
        <div class="form-group">
            <input type="text" class="form-control" id="title" name="title" placeholder="Title" autofocus required>
        </div>
        <button type="submit" id="submit" class="btn btn-plex">Search</button>
    </form>
</div>
<div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
    <h2>Search results:</h2>
    <br>
    <table class="table table-bordered table-hover">
        <tr class="active">
            <td>Release:</td>
            <td>Title:</td>
            <td>IMDB</td>
            <td>Submit:</td>
        </tr>
        @foreach($json['Search'] as $movie)
            <tr>
                <td>{{ $movie['Year'] }}</td>
                <td>{{ $movie['Title'] }}</td>
                <td><a href="http://imdb.com/title/{{ $movie['imdbID'] }}">Link</a></td>
                <td class="text-center"><a href="{{ route('submitrequest', $movie['imdbID']) }}"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></td>
            </tr>
        @endforeach
    </table>
</div>
@stop