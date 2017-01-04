<div class="container">
    <div class="col-xs-12 col-md-10 col-md-offset-1">
        <button id="pending" class="btn btn-default">Pending</button>
        <button id="filled" class="btn btn-default">Filled</button>
        <button id="declined" class="btn btn-default">Declined</button>
        <button id="cancelled" class="btn btn-default">Cancelled</button>
        <div id="requests">
        </div>
    </div>
</div>
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

    $('#cancelled').on('click', function() {
        changeActive.call(this);
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '/admin/requests/cancelled',
                success: function (response) {
                    $('#requests').html(response);
                },
                error: function() {
                    alert('Unable to retrieve cancelled requests.')
                }
            });
        });
    });

</script>
@stop