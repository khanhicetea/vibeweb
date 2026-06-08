$(function () {
    $('.form-stack input').on('input', function () {
        $(this).siblings('small').fadeOut(120);
    });
});
