@extends('myapp')
@section('assets')
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/assets/fancyBox/source/jquery.fancybox.css?v=2.1.5') }}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset('/assets/fancyBox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5') }}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset('/assets/fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7') }}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset('/assets/jQueryUI/jquery-ui.min.css') }}">
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
    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" id="deleteProductButton">
          <span class="glyphicon glyphicon-remove"></span>
        Delete this product
    </button>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update this product</div>
                    <div class="panel-body">
                        <div id="successAjax" style="display: none"></div>
                        <div id="errorAjax" style="display: none"></div>
                        {!! Form::model($product, ['id' => 'updateProductForm', 'method' => 'PATCH', 'url' => ['admin/products/update', $product->id]]) !!}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input id = "token" type="hidden" name="token" value="{{ \MyHelperFacade::tokenEncrypt() }}">

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
                                <label class="col-md-4 control-label">Price in $</label>
                                <div class="col-md-6">
                                    {!! Form::text('price',null,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            @if($mainPhoto == null)
                                <div class="form-group">
                                    <img id="noImage" src="{{ asset('assets/uploads/no-thumb.png') }}" width="300px" height="250px"/>
                                </div>
                            @else

                            <div class="form-group" id="gallery">

                                <a class="fancybox" data-fancybox-group="gallery" href="{{ $mainPhoto->title }}" width ="100px" height="80px">
                                    <button class="btn btn-default btn-sm buttonPicture" type="button" id="buttonPhoto-{{ $mainPhoto->id}}" data-id="{{ $mainPhoto->id }}" style="display: none">Make main</button>
                                    <img id="mainPhoto" class= "mainPhoto" src="{{ $mainPhoto->title }}" alt="" width="100" height="80" data-product-id="{{ $product->id }}" />
                                </a>
                                <div class="sortable">
                                  @foreach($photos as $photo)
                                      <?php if($photo->title == $mainPhoto->title) {
                                          continue;
                                      } ?>
                                    <a class="fancybox" data-fancybox-group="gallery" href="{{ $photo->title }}">
                                        <button class="btn btn-default btn-sm buttonPicture" type="button" id="buttonPhoto-{{ $photo->id}}" data-id="{{ $photo->id }}">Make main</button>
                                        <img src="{{ $photo->title }}" alt="" width="100" height="80" />
                                    </a>
                                  @endforeach
                                </div>


                               <!--  <label class="col-md-4 control-label">Upload photo for a product</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" multiple name="file[]">
                                </div> -->
                            </div>
                            @endif
                        <br />
                            <div class="form-group">
                                <label class="col-md-4 control-label">Select product categories</label>
                                <div class="col-md-6">
                                   <select id="categories_list" class="form-control" multiple name="categories_list[]" tabindex="-1" style="display: none">
                                       @foreach($categories as $category)
                                        <?php echo \MyHelperFacade::editFilterLeaf($category, $currentCategories) ?>
                                       @endforeach
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
                    <h4 class="modal-title" id="myModalLabel">Confirm delete</h4>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmDelete" data-delete-value="{{ $product->id }}"data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('sources')
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/js/select2.min.js"></script>
    <script src="{{ asset('/js/selectedTags.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/fancyBox/source/jquery.fancybox.pack.js?v=2.1.5') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/elevateZoom/jquery.elevatezoom.js') }}"></script>

    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <script type="text/javascript" src="{{ asset('/assets/fancyBox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/fancyBox/source/helpers/jquery.fancybox-media.js?v=1.0.6') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7') }}"></script>
    <script src="{{ asset('/assets/jQueryUI/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/productGallery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/productAddDelete.js') }}"></script>
@endsection