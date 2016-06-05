@extends('partials.master')

@section('content')
    @if (Auth::check())
        <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
            @include('partials.requestform')

            @if(!empty($json))
                @foreach ($json['Search'] as $movie)
                    <form role="form" method="POST" action="{{ route('submitrequest') }}">
                        {{ csrf_field() }}
                        <div class="col-xs-12 col-md-4">
                            <input type="image" src="{{ $movie['Poster'] }}" required><br>
                            <input id="title" hidden="true" name="title" readonly="readonly" value="{{ $movie['Title'] }}">
                            <input id="year" hidden="true" name="year" readonly="readonly" value="{{ $movie['Year'] }}">
                            {{ $movie['Title'] . " - " . $movie['Year'] }}
                        </div>
                    </form>
                @endforeach
            @endif
        </div>
    @endif
@stop