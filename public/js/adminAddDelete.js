$(document).ready(function() {
    $('li').on('click', function(e) {
        e.stopPropagation();
        $('li').removeClass('selected');
        $(this).addClass('selected');
        data = $(this).data('id');

        $('<p><input type="text" id="addCategory" size="20" placeholder="Enter your text here"><a href="#" id="remScnt">Remove</a></p>').appendTo($('#addWindow'));
        $('<input type="button" value="Add category" id="addButton">').appendTo($('#addWindow'));
        $('#remScnt').on('click', function() {
            $(this).parents('p').remove();
        });
    });
    //$('#idButton').click(function() {
    //    $.post('addCategory',
    //        {
    //            data_id: data,
    //
    //        })
    //})
});
