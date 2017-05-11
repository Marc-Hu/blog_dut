$(document).ready(function() {
    $('.add-message').hide();

    $('.repondre').on('click', function(e) {
        if ($(this).parent().find('.add-message').is(":visible")) {
            $(this).parent().find('.add-message').hide();
        } else {
            $(this).parent().find('.add-message').show();
        }
    });
});