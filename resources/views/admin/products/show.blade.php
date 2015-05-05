@extends('myapp')

@section('content')
    <form action="#" id="productDeleteForm" style="float:right;">
        <button name="deletebutton" type="submit" class="btn btn-danger">Delete this article</button>
    </form>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create new product</div>
                    <div class="panel-body">
                        <div id="successAjax" style="display: none"></div>
                        <div id="errorAjax" style="display: none"></div>
                        {!! Form::model($product, ['method' => 'PATCH', 'url' => ['admin/products/update', $product->id]]) !!}
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
                                <label class="col-md-4 control-label">Upload photo for a product</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" multiple name="file[]">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Select product categories</label>
                                <div class="col-md-6">
                                   <!-- <select id="categories_list" class="form-control" multiple name="categories_list[]" tabindex="-1" style="display: none">
                                        {{--{{ \MyHelperFacade::filterLeaf($categories) }}--}}
                                    </select> -->
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
   <!-- <form action="http://test1.com/admin/products/{{ $product->id }}/edit">
        <button type="submit" id="editButton" class="btn btn-info" >Edit this product</button>
    </form>
    <button type="button" id="deleteButton" class="btn btn-danger">Delete this product</button>

    <div class="description">
        {{ $product->description }}
    </div>
    <h5>
        @foreach($product->categories as $category)
            <li>{{ $category->name }} </li>
        @endforeach
    </h5> -->

@endsection

@section('sources')



@endsection