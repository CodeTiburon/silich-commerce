@extends('myapp')

@section('assets')

    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create new product</div>

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/products/create') }}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Enter the name of product</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Description</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="description" cols="20" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Upload photo for a product</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="file" multiple>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Select product categories</label>
                                <div class="col-md-6">
                                    <select id="categories_list" class="form-control" multiple name="categories_list[]" tabindex="-1" style="display: none">
                                        {{ \MyHelperFacade::filterLeaf($categories) }}
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create new product
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sources')
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/js/select2.min.js"></script>
    <script src="{{ asset('/js/selectedTags.js') }}"></script>
@endsection


@endsection