//Default setting for jQuey validator
jQuery.validator.setDefaults({
    errorElement: 'div',
    errorClass : 'vali-error',
    ignore: ':hidden , .ignore',
    errorPlacement: function ( error, element ) {
        error.addClass( "invalid-feedback" );
        error.insertAfter( element.parent() );
    },
    highlight: function ( element, errorClass, validClass ) {
        $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
    },
    unhighlight: function ( element, errorClass, validClass ) {
        $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
    },
    invalidHandler: function() {
        toastr.error("Please proceed with valid input data and try again", "Invalid Input");
    },
});