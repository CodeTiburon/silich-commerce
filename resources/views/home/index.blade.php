@extends('myapp')

@section('assets')

    <link href="{{ asset('/css/home.css') }}" rel="stylesheet" />

@endsection

@section('mainContent')

    <div class="row-fluid">
        <div class="col-sm-4">
            <ul class="list-group">
                @foreach($categories as $category)
                    <?php echo \MyHelperFacade::categoriesRender($category); ?>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-7 products">

        </div>
    </div>


    <input id = "token" type="hidden" name="_token" value="{{ \MyHelperFacade::tokenEncrypt() }}">

    <script type="text/template" id ="productTemplate">

        <div class="col-sm-3 product">

            <img src="<%= photo %>" width="200px" height="160px" data-id="<%=id %>"/>
            <p><%= name %></p>
            <p><%= description %></p>
            <span>Price: <%= price %>$</span>
            <br />
            <button class="btn btn-success btn-sm addToCart"><span class="glyphicon glyphicon-shopping-cart"> Add to cart</span></button>
        </div>
    </script>

    <div id="cart" class="col-sm-1">
        <div class="panel panel-default">
            <div class="panel panel-heading">
            <span class="glyphicon glyphicon-shopping-cart"> Cart</span>
            </div>
            <div class="panel panel-body shoppingCart">There are no products in your cart</div>
        </div>
    </div>
@endsection

@section('sources')
    <script type="text/javascript" src="{{ asset('/assets/lodash/lodash.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/homeCategoriesProducts.js') }}"></script>
@endsection