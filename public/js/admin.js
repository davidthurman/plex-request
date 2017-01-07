$(document).ready(function() {
    $("#flashMessage").delay(5000).slideUp("slow");
    $(".alert").delay(4000).slideUp("slow");
    $(".display-fade").delay(25).animate({"opacity": "1"}, 800);
    $(".table-fade").delay(25).animate({"opacity": "1"}, 800);

    $('.tabs').on('click', function() {
        $('.tabs').removeClass('active');
        $(this).addClass('active');
    });

    $(document).on('click', '#requests-tab,#pending', function() {
        $.ajax({
            type: 'GET',
            url: '/admin/requests/pending',
            success: function (response) {
                $('#panel-body').html(response);
            },
            error: function() {
                alert('Unable to retrieve pending requests.')
            }
        });
    });

    $(document).on('click', '#filled', function() {
        $.ajax({
            type: 'GET',
            url: '/admin/requests/filled',
            success: function (response) {
                $('#panel-body').html(response);
            },
            error: function() {
                alert('Unable to retrieve filled requests.')
            }
        });
    });

    $(document).on('click', '#declined', function() {
        $.ajax({
            type: 'GET',
            url: '/admin/requests/declined',
            success: function (response) {
                $('#panel-body').html(response);
            },
            error: function() {
                alert('Unable to retrieve declined requests.')
            }
        });
    });

    $(document).on('click', '#cancelled', function() {
        $.ajax({
            type: 'GET',
            url: '/admin/requests/cancelled',
            success: function (response) {
                $('#panel-body').html(response);
            },
            error: function() {
                alert('Unable to retrieve cancelled requests.')
            }
        });
    });

    $(document).on('click', '#users-tab', function() {
        $.ajax({
            type: 'GET',
            url: '/admin/users',
            success: function (response) {
                $('#panel-body').html(response);
            },
            error: function() {
                alert('Unable to retrieve users.')
            }
        });
    });

    $(document).on('click', '#errors-tab', function() {
        $.ajax({
            type: 'GET',
            url: '/admin/errors',
            success: function (response) {
                $('#panel-body').html(response);
            },
            error: function() {
                alert('Unable to retrieve errors.')
            }
        });
    });

    $('#requests-tab').click();

});



