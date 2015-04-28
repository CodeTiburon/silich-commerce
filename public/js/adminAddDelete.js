$(document).ready(function() {

    var $_token = $('#token').val();
    var selectButton = function(e) {
        e.stopPropagation();
        $('li').removeClass('current');
        $(this).addClass('current');
        //data = $(this).data('id');
        //element = $(this);
        $('#categoryForm').fadeIn(800);
    };
    //Add form showing

    $('ul').on('click','li', function(e) {
        e.stopPropagation();
        $('li').removeClass('active');
        $(this).addClass('active');
        //data = $(this).data('id');
        //element = $(this);
        $('#categoryForm').fadeIn(800);
    });

    $('#testButton').click(function() {
        $.post('addCategory');
    });

    //Add children category

    $('#addButton').on('click', function() {
        var newCategory = $('#addCategory').val();
        var data = $('li.active').data('id');
        $.ajax({
            url: 'add',
            type: 'post',
            headers: { 'X-XSRF-TOKEN' : $_token },
            data: {
                data_id : data,
                new_category : newCategory,
                target: 'add'
            },
            success: function(xhr) {
                $('#successMessage')
                    .removeClass('alert-danger')
                    .addClass('alert-success').text("The category has been created successfully")
                    .show('500').delay(3000)
                    .hide('slow');

                var parent = xhr.parentId;
                var html = xhr.myHtml;
                var element = $('li[data-id="'+parent+'"]');
                if(element.children().length < 3) {
                    $("<ul>"+html+"</ul>").appendTo(element).hide().show('slow');
                }
                else {
                    element = $('li[data-id="'+parent+'"] > ul');
                    $(html).appendTo(element).hide().show('slow');
                }
            },
            error: function(xhr) {
                if(xhr.responseJSON) {
                    var data = xhr.responseJSON;
                    $.each(data, function(index, value) {
                        $('#successMessage')
                            .removeClass('alert-success')
                            .addClass('alert-danger').text(value)
                            .show('500').delay(3000)
                            .hide('slow');
                    });
                } else {
                    $('#successMessage')
                        .removeClass('alert-success')
                        .addClass('alert-danger').text("Can't create a category now, please try again later")
                        .show('500').delay(3000)
                        .hide('slow');
                }
            }
    })
    });

    //Add sibling category

    $('#addSibling').on('click', function() {
        var newCategory = $('#addCategory').val();
        var data = $('li.active').data('id');
        $.ajax({
            url: 'sibling',
            type: 'post',
            headers: { 'X-XSRF-TOKEN' : $_token },
            data: {
                data_id : data,
                new_category : newCategory,
                target: 'sibling'
            },
            success: function(xhr) {
                $('#successMessage')
                    .removeClass('alert-danger')
                    .addClass('alert-success').text("The category has been created successfully")
                    .show('500').delay(3000)
                    .hide('slow');

                var parent = xhr.parentId;
                var html = xhr.myHtml;
                var element = $('li[data-id="'+parent+'"]');
                $(html).insertAfter(element).hide().show('slow');

            },
            error: function(xhr) {
                if(xhr.responseJSON) {
                    var data = xhr.responseJSON;
                    $.each(data, function(index, value) {
                        $('#successMessage')
                            .removeClass('alert-success')
                            .addClass('alert-danger').text(value)
                            .show('500').delay(3000)
                            .hide('slow');
                    });
                } else {
                    $('#successMessage')
                        .removeClass('alert-success')
                        .addClass('alert-danger').text("Can't create a category now, please try again later")
                        .show('500').delay(3000)
                        .hide('slow');
                }
            }
        })

    });

    //Remove category

    $('ul').on('click','li .btn', function(e) {
        e.stopPropagation();
        $('#categoryForm').fadeOut(800);
        var data = $(this).closest("li").data('id');
        var element = $(this).closest("li");
        $('#myModal').modal('show');
        $('#confirmDelete').on('click', function() {
            $.ajax({
                url: 'delete',
                type: 'post',
                headers: { 'X-XSRF-TOKEN' : $_token },
                data: {
                    data_id : data
                },
                success: function() {
                    $('#successMessage')
                        .removeClass('alert-danger')
                        .addClass('alert-success').text("The category has been deleted successfully")
                        .show('500').delay(3000)
                        .hide('slow');
                    element.hide('slow');
                },
                error: function() {
                    $('#successMessage').removeClass('alert-success')
                        .addClass('alert-danger').text("Can't delete a category now, please try again later")
                        .show('500').delay(3000)
                        .hide('slow');
                }
            })
        });
    })
});
