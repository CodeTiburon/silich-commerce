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
                    <div class="panel-body">
                        <!-- Success without ajax -->
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                <h3>{{ Session::get('success') }}</h3>
                            </div>
                        @endif
                        <div id="successAjax" style="display: none"></div>
                        <div id="errorAjax" style="display: none"></div>
                        <form id="productCreateForm" class="form-horizontal" role="form" method="POST" action="{{ url('/admin/products/create') }}" enctype="multipart/form-data">
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
                                <label class="col-md-4 control-label">Price in $</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Upload photo for a product</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" multiple name="file[]">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Select product categories</label>
                                <div class="col-md-6">
                                    <select id="categories_list" class="form-control" multiple name="categories_list[]" tabindex="-1" style="display: none">
                                        @foreach($categories as $category)
                                        <?php echo \MyHelperFacade::filterLeaf($category) ?>
                                        @endforeach
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
                            <!-- Error handling without ajax -->
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(Session::has('error'))
                                <div class="alert alert-danger">
                                   <p> {{ Session::get('error') }} </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sources')
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/js/select2.min.js"></script>
    <script src="{{ asset('/js/selectedTags.js') }}"></script>
    <script src="{{ asset('/js/productAddDelete.js') }}"></script>
@endsection


@endsection