<html>
    <head>
        <title>Plex Requests</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="javascript" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">
    </head>
    <body>
        <div class="container">
        @include('partials.navbar')
        @yield('content')
        @include('partials.footer')
        </div>
    </body>
</html>
