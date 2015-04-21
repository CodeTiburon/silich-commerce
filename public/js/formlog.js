$(document).ready(function() {

    $('#credFormLog').ajaxForm({
        success:function(data) {
            if(data.success == true) {
                window.location.replace(data.redirectTo);
            }
            else {
                $.each(data, function(index, value) {
                    var errorDiv = '#' + index +'_error';
                    $(errorDiv).addClass('bg-danger');
                    $(errorDiv).empty().append(value);
                });
                $('#successMessage').empty();
            }
        }
    })

});
