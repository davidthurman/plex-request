<html>
    <head>
        <title>Admin Panel | Plex Requests</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
    </head>
    <body>
        <div class="container">
            @include('partials.flashmessage')
            <div class="col-md-12">
                <div class="panel panel-default panel-fade">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <div class="pull-left">
                                <ul class="nav nav-tabs">
                                    <li class="tabs" id="requests-tab"><a href="#" ><i class="glyphicon glyphicon-film"></i> Requests</a></li>
                                    <li class="tabs" id="users-tab"><a href="#"><i class="glyphicon glyphicon-user"></i> Users</a></li>
                                    <li class="tabs" id="errors-tab"><a href="#"><i class="glyphicon glyphicon-list"></i> Errors</a></li>
                                </ul>
                            </div>
                            <div class="pull-right">
                                <ul class="nav nav-tabs">
                                    <li class="tabs"><a href="{{ route('home') }}"><i class="glyphicon glyphicon-home"></i> Return</a></li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- Filled by partials after ajax call -->
                    <div id="panel-body" class="panel-body">
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{ asset('/js/admin.js') }}"></script>
    </body>
</html>