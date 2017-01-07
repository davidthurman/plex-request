@foreach($requests as $request)
    <div id="asset-{{ $request['id'] }}" class="row" data-id="{{ $request['id'] }}">
        <div class="col-md-4 col-xs-12">
            @if($request->media_type == 'movie')
                <a href="https://www.themoviedb.org/movie/{{ $request['tmdbid'] }}" target="new"><img class="img-thumbnail" src="{{ $request->getPosterPath($request['tmdbid'], $request->media_type) }}"></a>
            @elseif($request->media_type == 'tv')
                <a href="https://www.themoviedb.org/tv/{{ $request['tmdbid'] }}" target="new"><img class="img-thumbnail" src="{{ $request->getPosterPath($request['tmdbid'], $request->media_type) }}"></a>
            @endif
        </div>
        <div class="col-md-4 col-xs-12 text-left">
            <h2>{{ $request['title'] }} ({{ $request['year'] }})</h2>
            <strong>Date requested:</strong> {{ date('M d, Y', strtotime($request['created_at'])) }}
            @if($path == 'filledrequests')<br><strong>Date filled:</strong> {{ date('M d, Y', strtotime($request->updated_at)) }}@endif
            @if($path == 'declinedrequests')<br><strong>Date declined:</strong> {{ date('M d, Y', strtotime($request->updated_at)) }}@endif
            <p>Notes: {{ $request['response_notes'] or 'No response from admin' }}</p>
        </div>
        <div class="col-md-4 pull-right">
            <a href="/cancel/{{ $request['id'] }}" id="cancel-button-{{ $request['id'] }}" class="cancel-button btn btn-danger" data-id="{{ $request['id'] }}">
                <span class="glyphicon glyphicon-refresh hidden"></span> Cancel
            </a>
        </div>
    </div>
    <hr class="divider">
@endforeach
<script type="text/javascript">
    $(function() {

        function addLoadingState() {
            $(this).addClass('disabled');
            $(this).children().removeClass('hidden').addClass('spinning');
        }

        $('.cancel-button').on('click', function (e) {
            e.preventDefault();
            addLoadingState.call(this);
            var id = $(this).data('id');
            var url = $(this).attr('href');

            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                success: function (response) {
                    if(response.status == 'success') {
                        $('#asset-' + id).fadeOut(500).next().fadeOut(500);
                    } else {
                        alert('Failed to cancel request.');
                    }
                },
                error: function () {
                    alert('Unable to cancel the request.')
                }
            });

        });
    });
</script>