@extends('myapp')

@section('content')

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="alert alert-success" id="successMessage"></div>

            <ul class="list-group">
                @foreach($categories as $node)
                     <?php echo \MyHelperFacade::renderNode($node); ?>
                @endforeach
            </ul>

            <div id ='addWindow'></div>
            <form id="categoryForm" class="form-inline"><input id = "token"type="hidden" name="_token" value="{{ \MyHelperFacade::tokenEncrypt() }}">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="formGroupInputSmall">Add category</label>
                    <input type="text" id="addCategory" class="form-control" name="categoryName" placeholder="Enter here">
                        <div class="btn-group">
                            <button type="button" id="addButton" class="btn btn-small btn-success">Add Child Category</button>
                            <button type="button" id="addSibling" class="btn btn-small btn-primary">Add Sibling Category</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>


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