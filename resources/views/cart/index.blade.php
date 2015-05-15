@extends('myapp')

@section('content')

        <div id="successAjax" class="alert" style="display: none"></div>

        <div class="panel panel-primary">
            <div class="panel panel-heading">

                <h4>Your cart</h4>

            </div>
            <div class="panel panel-body">

                <table class="table">
                    <caption>Products</caption>

                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($products as $product)

                        <tr class="currentProduct">
                            <td><img src="{{ $product->photo }}" height="150px" width="200px"/></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td class="productPrice">{{ $product->price }}</td>
                            <td><input type="number" data-old="" value="{{ $product->quantity }}" class="form-control numberProduct" ></td>
                            <td><button type="button" class="btn btn-danger btn-sm deleteFromCart">Delete product from cart</button>
                            <input type="hidden" data-id="{{ $product->id }}"></td>

                        </tr>

                    @endforeach

                </table>

                <input id = "token" type="hidden" name="_token" value="{{ \MyHelperFacade::tokenEncrypt() }}">

                <div id="sumAndConfirm">
                    Summary:
                    <p><span class="priceColumn">{{ $sum }}</span>$</p>
                    <a type="button" href ="{{ url('/order/') }}"class="btn btn-success btn-lg confirmButton"> Confirm your buying</a>
                </div>

            </div>

        </div>

@endsection

@section('sources')

    <script src="{{ asset('/js/cartManager.js') }}"></script>

@endsection