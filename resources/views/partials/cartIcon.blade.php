<div id="cart" class="col-sm-1">
    <div class="panel panel-default">

        <div class="panel panel-heading">
            <span class="glyphicon glyphicon-shopping-cart"> Cart</span>

        </div>
        <button class="btn btn-xs btn-danger clearCart"><span class="glyphicon glyphicon-remove"> Clear cart</span></button>

        <div class="panel panel-body shoppingCart">

            @if(\Session::has('products'))
                Quantity : {{count(\Session::get('products')) }}
                Price : {{ \MyHelperFacade::displayPrice(Session::get('products')) }}
                @else
                There are no products in your cart
            @endif

        </div>


    </div>

    <a type="button" href="{{ url('/cart/display') }}" class="btn btn-primary btn-md cartLink">View full cart</a>
</div>