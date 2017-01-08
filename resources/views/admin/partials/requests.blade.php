<div class="row text-center">
    <a id="pending" class="btn btn-default status-buttons">Pending</a>
    <a id="filled" class="btn btn-default status-buttons">Filled</a>
    <a id="declined" class="btn btn-default status-buttons">Declined</a>
    <a id="cancelled" class="btn btn-default status-buttons">Cancelled</a>
</div>
<br>
@if(count($plexrequests) > 0)
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>Title</th>
            <th>User</th>
            <th>Requested on</th>
            <th>Status</th>
            @if($path != 'admin/requests/cancelled')
                <th>Action</th>
            @endif
        </tr>
        @foreach($plexrequests as $plexrequest)
            <tr data-id="{{ $plexrequest->id }}">
                <td>
                    @if($plexrequest->media_type === 'movie')
                        <a href="https://www.themoviedb.org/movie/{{ $plexrequest->tmdbid }}" target="_blank">{{ $plexrequest->title }}</a>
                    @else
                        <a href="https://www.themoviedb.org/tv/{{ $plexrequest->tmdbid }}" target="_blank">{{ $plexrequest->title }}</a>
                    @endif
                </td>
                <td>{{ $plexrequest->user }}</td>
                <td>{{ date( 'F d, Y', strtotime($plexrequest->created_at)) }}</td>
                <td>
                    @php
                        switch($plexrequest->status) {
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
                @if($path != 'admin/requests/cancelled')
                    <td>
                        @if($plexrequest->status === 0 || $plexrequest->status === 2)
                            <a id="{{ $plexrequest->id }}" class="btn btn-xs btn-primary white-link fillbutton" data-toggle="modal" data-target="#fillmodal">Fill</a>
                        @endif
                        @if($plexrequest->status === 0 || $plexrequest->status === 1)
                            <a id="{{ $plexrequest->id }}" class="btn btn-xs btn-danger white-link declinebutton" data-toggle="modal" data-target="#declinemodal">Decline</a>
                        @endif
                    </td>
                @endif
            </tr>
        @endforeach
    </table>
<form method="POST" action="">
    {{ csrf_field() }}
    <div id="fillmodal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Write a comment for the user:</h4>
                </div>
                <div class="modal-body">
                    <textarea class="adminresponse" name="adminresponse" rows="5" cols="75"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary white-link">Submit</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>
<form method="POST" action="">
    {{ csrf_field() }}
    <div id="declinemodal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Write a comment for the user:</h4>
                </div>
                <div class="modal-body">
                    <textarea class="adminresponse" name="adminresponse" rows="5" cols="75"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary white-link">Submit</button>
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