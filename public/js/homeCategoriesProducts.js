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

                        var categories = productHtml(products[product]);

                        $('.products').append(categories).hide().fadeIn('slow');
                    }
                }

            })
        }
    });

    $(document).on('mouseenter','.product', function(e) {
       $(this).addClass('showProducts');
        $(this).on('mouseleave', function() {
            $(this).removeClass('showProducts');
        });
        $(this).on('click', function() {
            var data = $(this).find("img").data('id');
            $.ajax({
                url: '/products/show-product/',
                type: 'POST',
                headers: { 'X-XSRF-TOKEN' : $_token },
                data: {
                    prod_id: data
                },
                success: function(data) {
                    window.location.replace(data.redirectTo);
                }
            })
        })
    })
});
