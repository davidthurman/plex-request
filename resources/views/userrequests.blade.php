@extends('layout.public')
@section('title')Your requests @stop
@section('content')
<div id="requestsdisplay">
    <div class="col-xs-12 col-md-10 col-md-offset-1 text-center">
        <h2>Your requests:</h2>
        <br>
        <ul class="nav nav-tabs">
            <li id="pending" @if($path == 'pendingrequests')class="active"@endif><a href="#">Pending</a></li>
            <li id="filled" @if($path == 'filledrequests')class="active"@endif><a href="#">Filled</a></li>
            <li id="declined" @if($path == 'declinedrequests')class="active"@endif><a href="#">Declined</a></li>
        </ul>
        <br>
        <div id="requests">
            @yield('partials.userrequests')
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
            $("li").removeClass("active");
            $(this).addClass("active");
        }

        $('#pending').on('click', function() {
            changeActive.call(this);
            $(document).ready(function() {
                $.ajax({
                    type: 'GET',
                    url: '/pendingrequests',
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
                    url: '/filledrequests',
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
                    url: '/declinedrequests',
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