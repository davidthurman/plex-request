@extends('layout.admin')
@section('title')Admin @stop
@section('content')
    <div class="container">
        <div class="col-xs-12 col-md-10 col-md-offset-1">

            <button id="pending" class="btn btn-default @if($path == 'admin/requests/pending' || $path == 'admin/requests')btn-primary @endif">Pending</button>
            <button id="filled" class="btn btn-default @if($path == 'admin/requests/filled')btn-primary @endif">Filled</button>
            <button id="declined" class="btn btn-default @if($path == 'admin/requests/declined')btn-primary @endif">Declined</button>

            <h2>
                @if($path == 'admin/requests/pending' || $path == 'admin/requests')Pending @endif
                @if($path == 'admin/requests/filled')Filled @endif
                @if($path == 'admin/requests/declined')Declined @endif
                requests:
            </h2>
            <div id="requests">
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
                </table>
            </div>
        </div>
    </div>
@stop

@section('jsadditions')
<script type="text/javascript">

    function changeActive() {
        $(".btn").removeClass("btn-primary");
        $(this).addClass("btn-primary");
    }

    $('#pending').on('click', function() {
        changeActive.call(this);
        $(function () {
            $.ajax({
                type: 'GET',
                url: '/admin/requests/pending',
                success: function (requests) {
                    console.log('success', requests);
                },
                error: function() {
                    alert('Unable to retrieve pending requests.')
                }
            });
        });
    });

    $('#filled').on('click', function() {
        changeActive.call(this);
        $(function () {
            $.ajax({
                type: 'GET',
                url: '/admin/requests/filled',
                success: function (requests) {
                    console.log('success', requests);
                },
                error: function() {
                    alert('Unable to retrieve filled requests.')
                }
            });
        });
    });

    $('#declined').on('click', function() {
        changeActive.call(this);
        $(function () {
            $.ajax({
                type: 'GET',
                url: '/admin/requests/declined',
                success: function (requests) {
                    console.log('success', requests);
                    $('#requests').load(document.URL +  ' #requests');
                },
                error: function() {
                    alert('Unable to retrieve declined requests.')
                }
            });
        });
    });

</script>
@stop