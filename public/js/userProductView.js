$(document).ready(function() {

    var $_token = $('#token').val();

    //gallery
    $('.fancybox').fancybox();

    //pictures zoom
    $('img').elevateZoom({tint:true, tintColour:'#F90', tintOpacity:0.5});


    $(document).on('click','.addToCart', function(e){
        e.stopPropagation();
        var data = $('#mainPhoto').data('product-id');
        $.ajax({
            url: '/cart/add',
            type: 'POST',
            headers: { 'X-XSRF-TOKEN' : $_token},
            data: {
                product_id: data
            },
            success: function(data) {
                var quantity = data.quantity;
                var sum= data.price;
                $('.shoppingCart').empty().text('Quantity: ' + quantity + ' Price: ' + sum);
                $('.cartLink').show('slow');
            }
        })
    });

    $('.clearCart').on('click', function() {
        $.ajax({
            url: '/cart/clear',
            type: 'GET',
            headers: { 'X-XSRF-TOKEN' : $_token},
            success: function(data) {
                window.location.replace(data.redirectTo);
            }
        })
    });
});
