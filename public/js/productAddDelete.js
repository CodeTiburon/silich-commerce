$(document).ready(function() {

    $('#productCreateForm').ajaxForm({
        success: function(data) {
            window.location.replace(data.redirectTo);
            $('#successAjax').empty();
            var message = data.success;
            $('#successAjax').addClass('alert alert-success').append(message).show('slow');

        },
        error: function(data) {
            $('#errorAjax').empty().hide('slow');
            var message = data.responseJSON;
            $.each(message, function(index, value) {
                $('#errorAjax').addClass('alert alert-danger').append(value).show('slow');
            })
        }
    })

});
