$(document).ready(function() {
    $('#test').slideUp('fast');
    $('li').click(function(e) {
        e.stopPropagation();
        $('input').remove();
        var $element = $(this);
        //var i = .size() + 1;
        $element.addClass('selected');
        var data = $element.data('id');

        $('<p><input type="text" class="categoryToAdd"><a href="#" class="remScnt">Remove</a></p>').appendTo($element);

    })

});
