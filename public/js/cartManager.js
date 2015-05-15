$(document).ready(function() {

    var $_token = $('#token').val();

    //Delete product from cart and from session
   $('.deleteFromCart').on('click', function() {
       var data = $(this).next('input').data('id');
       var target = $(this).parents('.currentProduct');


       var prodPrice = $(this).parent().prevAll('.productPrice').text();
       var finalPrice = prodPrice * $(this).parent().prev().find('input').val();

       $.ajax({
           url: '/cart/delete',
           type: 'POST',
           headers: { 'X-XSRF-TOKEN' : $_token },
           data: {
               delete_id: data
           },
           success: function(data) {

               if (data.status == true) {
                   target.hide('slow');

                   var sum = $('.priceColumn').text();
                   $('.priceColumn').text(sum - finalPrice);

                   $('#successAjax').text('Product was successfully deleted').addClass('alert-success').show('slow').delay(2500).hide('slow');
               }

           }

       })
   });

    $('.numberProduct').on('click', function() {
        $(this).data('old', $(this).val());
    });




    //update number of products
    $('.numberProduct').on('change', function() {
        var that = $(this);
        var oldNumber = $(this).data('old');

        var number = $(this).val();

        var productId = $(this).parent().next().find('input').data('id');
        var target = $(this).parents('.currentProduct');

        var prodPrice = $(this).parent().prevAll('.productPrice').text();
        if (number < 0) {
            alert("Quantity cannot be negative");
            $(this).val(1);
        }

        $.ajax({
            url: '/cart/change',
            type: 'POST',
            headers: { 'X-XSRF-TOKEN' : $_token},
            data: {
                product_id: productId,
                number: number
            },
            success: function(data) {
              if (data.slice == true) {
                target.hide('slow');
              }
                var sum = $('.priceColumn').text();
                $('.priceColumn').text((parseFloat(sum) - (oldNumber * parseFloat(prodPrice))) + (parseFloat(prodPrice) * number));
                $(that).data('old', number);
            }
        })
    });

});
