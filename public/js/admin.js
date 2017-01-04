$(document).ready(function() {
    $("#flashMessage").delay(5000).slideUp("slow");
    $(".alert").delay(4000).slideUp("slow");
    $(".display-fade").delay(25).animate({"opacity": "1"}, 800);
    $(".table-fade").delay(25).animate({"opacity": "1"}, 800);

    $('.tabs').on('click', function() {
        $('.tabs').removeClass('active');
        $(this).addClass('active');
    });

    $('#requests-tab').click();
});