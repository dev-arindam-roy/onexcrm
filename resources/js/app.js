//Default settings toastr
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

//Play notification sound on success, error and warning
toastr.options.onShown = function() {
    if ($(this).hasClass('toast-success')) {
        var audio = $('#success-audio')[0];
        if (audio !== undefined) {
            audio.play();
        }
    } else if ($(this).hasClass('toast-error')) {
        var audio = $('#error-audio')[0];
        if (audio !== undefined) {
            audio.play();
        }
    } else if ($(this).hasClass('toast-warning')) {
        var audio = $('#warning-audio')[0];
        if (audio !== undefined) {
            audio.play();
        }
    }
};

//Back To Top Smooth Scroll
$(window).on('scroll', function () {
    if ($(this).scrollTop() > 100) {
        $('#SmoothScrollToTopBtN').fadeIn();
    } else {
        $('#SmoothScrollToTopBtN').fadeOut();
    }
});
$('#SmoothScrollToTopBtN').on('click', function () {
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
});

//Form reset
$('.reset-btn').on('click', function () {
    var formID = $(this).data('formid');
    $("#" + formID).validate().resetForm();
    $("#" + formID)[0].reset();
    $(".form-control").removeClass('is-valid');
    $(".form-control").removeClass('is-invalid');
});