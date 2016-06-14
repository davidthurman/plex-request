@extends('partials.master')

@section('content')
    @if (Auth::check())
        <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
            @include('partials.requestform')
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
                        <td class="text-center"><a href="{{ route('submitrequest', $movie) }}"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
@stop