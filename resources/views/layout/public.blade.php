<html>
    <head>
        <title>@yield('title') | Plex Requests</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
    </head>
    <body>
        <div class="container">
            @include('layout.navbar')
            @include('partials.success')
            @include('partials.failure')
            @yield('content')
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#flashMessage")
                    .delay(5000)
                    .slideUp("slow");
            });
        </script>
        @yield('jsadditions')
    </body>
</html>
