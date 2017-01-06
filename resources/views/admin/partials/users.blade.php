@if(!$users->isEmpty())
    <form method="POST" action="{{ route('edituser') }}">
        {!! csrf_field() !!}
        <table class="table table-bordered table-hover table-striped">
            <tr class="active">
                <td>ID</td>
                <td>Name</td>
                <td>Admin?</td>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><a href="{{ route('showuser', $user->id) }}">{{ $user->name }}</a></td>
                    <td>
                        <input type="hidden" id="admincheckbox" name="admincheckbox[{{$user->id}}]" value="0">
                        <input type="checkbox" id="admincheckbox" name="admincheckbox[{{$user->id}}]" value="1" @if($user->admin or $user->id ==1) checked @endif onclick="changeAdminState()">
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td><button class="btn btn-plex">Submit</button></td>
            </tr>
        </table>
    </form>
@endif