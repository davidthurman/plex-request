<form method="post" action="">
    <table class="table table-bordered table-hover table-striped">
        <button id="pending" class="btn btn-default">Pending</button>
        <button id="filled" class="btn btn-default">Filled</button>
        <button id="declined" class="btn btn-default">Declined</button>
        <button id="cancelled" class="btn btn-default">Cancelled</button>
        <tr>
            <th>Title</th>
            <th>User</th>
            <th>Requested on</th>
            <th>Status</th>
        </tr>
        @foreach($requests as $request)
            <tr>
                <td>{{ $request->title }}</td>
                <td>{{ $request->user }}</td>
                <td>{{ $request->created_at }}</td>
                <td>{{ $request->status }}</td>
            </tr>
        @endforeach
    </table>
</form>