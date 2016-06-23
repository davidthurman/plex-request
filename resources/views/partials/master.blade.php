<html>
    <head>
        <title>Plex Requests</title>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

        <link type="text/javascript" rel="{{ asset('/js/bootstrap.min.js') }}">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
    </head>
    <body>
        <script src="{{ asset('/js/jquery-1.11.1.min.js') }}"></script>
        <div class="container">
        @include('partials.navbar')
        @include('partials.success')
        @include('partials.failure')
        @yield('content')
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#flashMessage")
                    .delay(4000)
                    .slideUp("slow");
            });
        </script>
        @yield('jsadditions')
    </body>
</html>
