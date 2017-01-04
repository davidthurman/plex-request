<html>
    <head>
        <title>Welcome | Plex Requests</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="{{ asset('/css/unauthed.css') }}">
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
        <script type="text/javascript">
            $(function() {

                $('#login-form-link').click(function(e) {
                    $("#login-form").delay(100).fadeIn(100);
                    $("#register-form").fadeOut(100);
                    $('#register-form-link').removeClass('active');
                    $(this).addClass('active');
                    e.preventDefault();
                });

                $('#register-form-link').click(function(e) {
                    $("#register-form").delay(100).fadeIn(100);
                    $("#login-form").fadeOut(100);
                    $('#login-form-link').removeClass('active');
                    $(this).addClass('active');
                    e.preventDefault();
                });

                $(".alert").delay(4000).slideUp("slow");

            });
        </script>
    </body>
</html>