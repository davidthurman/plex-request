<table class="table table-bordered table-hover table-striped">
    <tr class="active">
        <th>Name:</th>
        <th>Date:</th>
        <th>Description:</th>
        <th>Resolve:</th>
    </tr>
    @foreach ($errors as $error)
        <tr>
            <td>{{ $error->name }}</td>
            <td>{{ date( 'F d, Y', strtotime($error->date)) }}</td>
            <td>{{ $error->description }}</td>
            <td class="text-center"><a href="{{ route('resolveerror', $error->id) }}"><button class="btn btn-xs btn-success"><i class="fa fa-check" aria-hidden="true"></i></button></a></td>
        </tr>
    @endforeach
</table>