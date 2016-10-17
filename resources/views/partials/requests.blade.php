<h2>
    @if($path == 'admin/requests/pending' || $path == 'admin/requests')Pending @endif
    @if($path == 'admin/requests/filled')Filled @endif
    @if($path == 'admin/requests/declined')Declined @endif
    requests:
</h2>
<table class="table table-hover table-bordered">
    <tr class="active">
        <td>Title:</td>
        <td>Requester:</td>
        @if($path == 'admin/requests/pending')
            <td>Date Requested:</td>
        @endif
        @if($path == 'admin/requests/filled')
            <td>Date Filled:</td>
        @endif
        @if($path == 'admin/requests/declined')
            <td>Date Declined:</td>
        @endif
        @if($path == 'admin/requests/pending')
            <td>Fill:</td>
            <td>Decline:</td>
        @endif
    </tr>
    @if(isset($requests))
        @foreach ($requests as $request)
            <tr>
                @if($request->media_type == 'movie')
                    <td><a href="https://www.themoviedb.org/movie/{{ $request->tmdbid }}" target="new">{{ $request->title }}</a></td>
                @elseif($request->media_type == 'tv')
                    <td><a href="https://www.themoviedb.org/tv/{{ $request->tmdbid }}" target="new">{{ $request->title }}</a></td>
                @endif
                <td>{{ $request->user }}</td>
                @if($path == 'admin/requests/pending')
                    <td>{{ date('M d, Y', strtotime($request->created_at )) }}</td>
                @endif
                @if($path == 'admin/requests/filled' || $path == 'admin/requests/declined')
                    <td>{{ date('M d, Y', strtotime($request->updated_at)) }}</td>
                @endif
                @if($path == 'admin/requests/pending')
                    <td class="text-center"><a href="{{ route('fillrequest', $request['id']) }}"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></td>
                    <td class="text-center"><a href="{{ route('declinerequest', $request['id']) }}"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a></td>
                @endif
            </tr>
        @endforeach
    @endif
</table>