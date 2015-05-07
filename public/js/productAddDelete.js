$(document).ready(function() {

    var $_token = $('#token').val();

    //Validate input and create product
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
    });

    //Validate input and update product
    $('#updateProductForm').ajaxForm({
        success: function(data) {
            window.location.replace(data.redirectTo);
        },
        error: function(data) {
            $('#errorAjax').empty().hide('slow');
            var message = data.responseJSON;
            $.each (message, function(index, value) {
                $('#errorAjax').addClass('alert alert-danger').append(value).show('slow');
            })
        }
    });

    //Delete product and all related photos
    $('#confirmDelete').on('click', function() {
        var data =$(this).data('delete-value');
        $.ajax({
            url: '/admin/products/delete',
            type: 'POST',
            headers: { 'X-XSRF-TOKEN' : $_token},
            data: {
                delete_id : data
            },
            success: function(data) {
                window.location.replace(data.redirectTo);
            },
            error: function(data) {
                var message = data.errors;
                $('#errorAjax').hide().empty().append(message).show('slow');
            }

        })
    });

    //Change main photo
    $('[id^=buttonPhoto]').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var that = $(this);
        var targetPhoto = $(this).data('id');
        var productId = $('#mainPhoto').data('product-id');
        $.ajax({
            url: '/admin/products/make-main',
            type: 'POST',
            headers: { 'X-XSRF-TOKEN' : $_token},
            data: {
                product_id: productId,
                target_photo_id : targetPhoto
            },
            success: function(data) {

                $('.buttonPicture').show('slow').css({
                    'display' : 'inline'
                });

                that.hide('slow');
                $('.mainPhoto').removeClass('mainPhoto');
                that.next().addClass('mainPhoto');



            }
        })
    })

});
