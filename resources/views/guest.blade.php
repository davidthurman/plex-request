<html>
    <head>
        <title>Welcome | Plex Request</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('/css/guest.css') }}">
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('/js/guest.js') }}"></script>
</html>