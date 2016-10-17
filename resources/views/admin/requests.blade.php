@extends('layout.admin')
@section('title')Admin @stop
@section('content')
    <div class="container">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <button id="pending" class="btn btn-default">Pending</button>
            <button id="filled" class="btn btn-default">Filled</button>
            <button id="declined" class="btn btn-default">Declined</button>
            <div id="requests">
                @yield('partials.adminrequests')
            </div>
        </div>
    </div>
@stop
@section('jsadditions')
<script type="text/javascript">

    $(document).ready (function() {
        $('#pending').click();
    });

    function changeActive() {
        $(".btn").removeClass("btn-primary");
        $(this).addClass("btn-primary");
    }

    $('#pending').on('click', function() {
        changeActive.call(this);
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '/admin/requests/pending',
                success: function (response) {
                    $('#requests').html(response);
                },
                error: function() {
                    alert('Unable to retrieve pending requests.')
                }
            });
        });
    });

    $('#filled').on('click', function() {
        changeActive.call(this);
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '/admin/requests/filled',
                success: function (response) {
                    $('#requests').html(response);
                },
                error: function() {
                    alert('Unable to retrieve filled requests.')
                }
            });
        });
    });

    $('#declined').on('click', function() {
        changeActive.call(this);
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '/admin/requests/declined',
                success: function (response) {
                    $('#requests').html(response);
                },
                error: function() {
                    alert('Unable to retrieve declined requests.')
                }
            });
        });
    });

</script>
@stop