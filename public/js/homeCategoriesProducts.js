$(document).ready(function() {

    var $_token = $('#token').val();
    $('.category').on('click', function(e) {
        e.stopPropagation();
        $(this).children("ul").toggle('slow');

        var attr = $(this).attr('data-id');
        if (typeof attr !== typeof undefined && attr !== false ) {
            var data_id = $(this).data('id');
            $.ajax({
                url: '/products/display-products',
                type: 'POST',
                headers: { 'X-XSRF-TOKEN' : $_token },
                data: {
                    category_id: data_id
                },
                success: function(data) {
                    $('.products').empty();
                    var products = data.products;
                    for (product in products) {
                        var productHtml = _.template($('#productTemplate').html());

                        var productsDisplay = productHtml(products[product]);

                        $('.products').append(productsDisplay).hide().fadeIn('slow');
                    }
                }

            })
        }
    });

    $('.products').on('mouseenter','.product', function(e) {
        e.stopPropagation();
        e.preventDefault();
        $(this).addClass('showProducts');
        $(this).on('mouseleave', function () {
            $(this).removeClass('showProducts');
        });
    });

        $(document).on('click','.addToCart', function(e){
            e.stopPropagation();
            var data = $(this).siblings('img').data('id');
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
                    for(prop in sum){
                        alert(sum[prop]);
                    }
                    $('.shoppingCart').empty().text('Quantity: ' + quantity + ' Price: ' + sum);
                }
            })
        });
        $(document).on('click','.product', function(e) {
            e.stopPropagation();
            var data = $(this).find("img").data('id');
            $.ajax({
                url: '/products/show/'+data,
                type: 'POST',
                headers: { 'X-XSRF-TOKEN' : $_token},
                success: function(data) {
                    window.location.replace(data.redirectTo);
                }
            });
        })
});