$(document).ready(function() {
    $('.add-message').hide();
    $('.modifier').hide();

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

    $('.boutonModif').on('mouseover', function(e) {
        $(this).css("cursor", "pointer");
    });

    $('.boutonModif').on('click', function(e) {
        if ($('.modifier').is(':visible') && $(this).parent().find('.modifier').is(':hidden')) {
            $('.modifier').hide();
            $(this).parent().find('.modifier').show();
        } else if ($('.modifier').is(':visible') && $(this).parent().find('.modifier').is(':visible')) {
            $(this).parent().find('.modifier').hide();
        } else {
            $(this).parent().find('.modifier').show();
        }
    });

    $('#modifierNom').on('click', function(e) {

        var data = {
            "username": $('#user_id').val(),
            "nom": $(this).parent().find('input').val()
        };
    });

    $('#modifierEmail').on('click', function(e) {
        var data = {
            "username": $('#user_id').val(),
            "email": $(this).parent().find('input').val()
        };
    });

    $('#modifierDesc').on('click', function(e) {
        var data = {
            "username": $('#user_id').val(),
            "desc": $(this).parent().find('input').val()
        };
    });

    $('#modifierMdp').on('click', function(e) {
        var data = {
            "username": $('#user_id').val(),
            "mdp": $(this).parent().find('input').val()
        };
    });
});