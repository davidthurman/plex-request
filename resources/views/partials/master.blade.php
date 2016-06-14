<html>
    <head>
        <title>Plex Requests</title>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
        <link type="text/javascript" rel="{{ asset('/js/bootstrap.min.js') }}">
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
    </body>
</html>
