<div class="row text-center">
    <a id="pending" class="btn btn-default">Pending</a>
    <a id="filled" class="btn btn-default">Filled</a>
    <a id="declined" class="btn btn-default">Declined</a>
    <a id="cancelled" class="btn btn-default">Cancelled</a>
</div>
<br>
@if(count($requests) > 0)
<form method="post" action="">
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>Title</th>
            <th>User</th>
            <th>Requested on</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach($requests as $request)
            <tr>
                <td>
                    @if($request->media_type === 'movie')
                        <a href="https://www.themoviedb.org/movie/{{ $request->tmdbid }}" target="_blank">{{ $request->title }}</a>
                    @else
                        <a href="https://www.themoviedb.org/tv/{{ $request->tmdbid }}" target="_blank">{{ $request->title }}</a>
                    @endif
                </td>
                <td>{{ $request->user }}</td>
                <td>{{ date( 'F d, Y', strtotime($request->created_at)) }}</td>
                <td>@php
                        switch($request->status) {
                            case 0:
                                echo 'Pending';
                                break;
                            case 1:
                                echo 'Filled';
                                break;
                            case 2:
                                echo 'Declined';
                                break;
                            case 3:
                                echo 'Cancelled';
                                break;
                            default:
                                echo '?';
                        }
                    @endphp
                </td>
                <td>
                    @if($request->status === 0 || $request->status === 2)<a href="{{ route('fillrequest', $request->id) }}" class="btn btn-xs btn-primary white-link">Fill</a>@endif
                        @if($request->status === 0 || $request->status === 1)<a href="{{ route('declinerequest', $request->id) }}" class="btn btn-xs btn-danger white-link">Decline</a>@endif
                </td>
            </tr>
        @endforeach
    </table>
    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>
@else
    <div class="row text-center">
        <h2>No requests with this status.</h2>
    </div>
@endif