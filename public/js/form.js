$(document).ready(function() {

    //Register form validation
    $('#credForm').ajaxForm({
        success:function(data) {
            if(data.fail) {
                $.each(data.errors, function(index, value) {
                    var errorDiv = '#' + index +'_error';
                    $(errorDiv).addClass('bg-danger');
                    $(errorDiv).empty().append(value);
                });
                $('#successMessage').empty();
            }
            if(data.success) {
                window.location.replace(data.redirectTo);

            }
        },
        error: function(xhr) {
            if (xhr.responseJSON) {
                var data = xhr.responseJSON;

                $.each(data, function(index, value) {
                    var errorDiv = '#' + index +'_error';
                    $(errorDiv).addClass('bg-danger');
                    $(errorDiv).empty().append(value);
                });

                $('#successMessage').empty();
            }

        }
    });

    //order form validation
    $('#orderForm').ajaxForm({
        success:function (data) {
            if(data.fail) {
                $('#errors').empty();
                $.each(data.errors, function(index, value) {
                    $('#errors').append(value).show('slow');
                })
            }
            if(data.redirectTo) {
                window.location.replace(data.redirectTo);
            }
        }
    })
});