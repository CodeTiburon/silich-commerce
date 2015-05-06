@extends('myapp')
@section('assets')
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/js/fancyBox/source/jquery.fancybox.css?v=2.1.5') }}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset('/js/fancyBox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5') }}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset('/js/fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7') }}" type="text/css" media="screen" />
@endsection

@section('content')
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
    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
          <span class="glyphicon glyphicon-remove"></span>
    </button>
    <form action="{{ action('Admin\ProductController@postDelete', ['id' => $product->id]) }}" id="productDeleteForm" method= "POST" style="float:right;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-danger">Delete this product</button>
    </form>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create new product</div>
                    <div class="panel-body">
                        <div id="successAjax" style="display: none"></div>
                        <div id="errorAjax" style="display: none"></div>
                        {!! Form::model($product, ['id' => 'updateProductForm', 'method' => 'PATCH', 'url' => ['admin/products/update', $product->id]]) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Enter the name of product</label>
                                <div class="col-md-6">
                                    {!! Form::text('name',null,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Description</label>
                                <div class="col-md-6">
                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'cols' => '20', 'rows' => '10']) !!}
                                </div>
                            </div>

                            <div class="form-group">

                                <a class="fancybox" data-fancybox-group="gallery" href="{{ $mainPhoto }}" width ="350px" height="200px">
                                    <img src="{{ $mainPhoto }}" alt="" width="400" height="300" />
                                </a>
                                <br />
                                <br />

                                  @foreach($photos as $photo)
                                      <?php if($photo->title == $mainPhoto) {
                                          continue;
                                      } ?>
                                    <a class="fancybox" data-fancybox-group="gallery" href="{{ $photo->title }}">
                                        <button type="button" id="test">Test</button>
                                        <img src="{{ $photo->title }}" alt="" width="100" height="80" />
                                    </a>

                                  @endforeach


                               <!--  <label class="col-md-4 control-label">Upload photo for a product</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" multiple name="file[]">
                                </div> -->
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Select product categories</label>
                                <div class="col-md-6">
                                   <select id="categories_list" class="form-control" multiple name="categories_list[]" tabindex="-1" style="display: none">
                                        {{ \MyHelperFacade::editFilterLeaf($categories, $currentCategories) }}
                                   </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update product
                                    </button>
                                </div>
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    Are you sure you want delete this product?
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/js/select2.min.js"></script>
    <script src="{{ asset('/js/selectedTags.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/fancyBox/source/jquery.fancybox.pack.js?v=2.1.5') }}"></script>

    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <script type="text/javascript" src="{{ asset('/js/fancyBox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/fancyBox/source/helpers/jquery.fancybox-media.js?v=1.0.6') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/productGallery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/productAddDelete.js') }}"></script>
@endsection