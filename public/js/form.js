$(document).ready(function() {

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
        }
    })

});