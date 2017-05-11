$(document).ready(function() {
    $('.add-message').hide();

    $('.repondre').on('click', function(e) {
        if ($('.messages').find('.add-message').is(':visible') && $(this).parent().find('.add-message').is(':hidden')) {
            $('.messages').find('.add-message').hide();
            $(this).parent().find('.add-message').show();
        } else if ($('.messages').find('.add-message').is(':visible') && $('.messages').find('.add-message').is(':visible')) {
            $(this).parent().find('.add-message').hide();
        } else {
            $(this).parent().find('.add-message').show();
        }
    });
});