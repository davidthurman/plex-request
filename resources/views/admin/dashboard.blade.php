<html>
    <head>
        <title>@yield('title') | Plex Requests</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
        <script type="text/javascript" src="{{ asset('/js/admin.js') }}"></script>
    </head>
    <body>
        <div class="container">
            @include('partials.success')
            @include('partials.failure')
            <div class="col-md-12">
                <div class="panel panel-default panel-fade">
                    <div class="panel-heading">
                        <span class="panel-title">
                            <div class="pull-left">
                                <ul class="nav nav-tabs">
                                    <li class="tabs" id="requests-tab"><a href="#" ><i class="glyphicon glyphicon-print"></i> Requests</a></li>
                                    <li class="tabs" id="users-tab"><a href="#"><i class="glyphicon glyphicon-send"></i> Users</a></li>
                                    <li class="tabs" id="errors-tab"><a href="#"><i class="glyphicon glyphicon-list"></i> Errors</a></li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </span>
                    </div>
                    <!-- Filled by partials after ajax call -->
                    <div id="panel-body" class="panel-body">
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>