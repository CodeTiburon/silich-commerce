@extends('myapp')

@section('content')
    <div class="alert alert-success" id="successMessage"></div>

    <ul>
        @foreach($categories as $node)
             <?php echo \MyHelperFacade::renderNode($node); ?>
        @endforeach
    </ul>
    <div id ='addWindow'></div>
    <form id="categoryForm" class="form-group form-group-md">
        <label class="col-md-2 control-label" for="formGroupInputSmall">Add category</label>
        <input type="text" id="addCategory" class="form-control" placeholder="Enter here">
        <input id="addButton" class="btn btn-primary" value="Add Child Category">
        <input id="addSibling" class="btn btn-primary" value="Add Category on that level">
    </form>


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    Are you sure you want delete this category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmDelete" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('sources')
    <script src="{{ asset('/js/adminAddDelete.js') }}"></script>
@endsection