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
                @if($path == 'filledrequests')<br><strong>Date filled:</strong> {{ date('M d, Y', strtotime($request->updated_at)) }}@endif
                @if($path == 'declinedrequests')<br><strong>Date declined:</strong> {{ date('M d, Y', strtotime($request->updated_at)) }}@endif
            </div>
        </div>
    </div>
@endforeach