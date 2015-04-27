$(document).ready(function() {

    //Add form showing

    $('li').on('click', function(e) {
        e.stopPropagation();
        $('li').removeClass('selected');
        $(this).addClass('selected');
        data = $(this).data('id');
        $('#categoryForm').fadeIn(800);
    });

    $('#testButton').click(function() {
        $.post('addCategory');
    });

    //Add children category

    $('#addButton').on('click', function() {
        var newCategory = $('#addCategory').val();
        $.post('add',
            {
                "_token": "{{ csrf_token() }}",
                data_id : data,
                new_category : newCategory
            }
        );
        $('#successMessage').text("The category has been created successfully").show('500').delay(3000).hide('slow');
    });

    //Add sibling category

    $('#addSibling').on('click', function(e) {
        var newCategory = $('#addCategory').val();
        $.post('sibling',
            {
                "_token": "{{ csrf_token() }}",
                data_id : data,
                new_category : newCategory
            }
        );
        $('#successMessage').text("The category has been created successfully").show('500').delay(3000).hide('slow');
    });

    //Remove category

    $('li .btn').on('click', function(e) {
        e.stopPropagation();
        $('#categoryForm').fadeOut(800);
        var data = $(this).closest("li").data('id');
        $('#myModal').modal('show');
        $('#confirmDelete').on('click', function() {
            $.post('delete',
                {
                    data_id : data
                });
            $('#successMessage').text("The category has been deleted successfully").show('500').delay(3000).hide('slow');
        });
    })
});
