@extends('myapp')

@section('content')

      <h2>Your cart</h2>
        <div id="successAjax" style="display: none"></div>

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

                <tr>
                    <td><img src="{{ $product->photo }}" height="150px" width="200px"/></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td><input type="number" value="{{ $product->quantity }}" class="numberProduct" ></td>
                    <td><button type="button" class="btn btn-danger btn-sm deleteFromCart">Delete product from cart</button>
                    <input type="hidden" data-id="{{ $product->id }}"></td>

                </tr>

            @endforeach

        </table>
        <div id="sumAndConfirm">
            Summary:
            <p class="priceColumn">{{ $sum }} $</p>
            <button class="btn btn-success btn-lg confirmButton"> Confirm your buying</button>
        </div>

@endsection

@section('sources')

    <script src="{{ asset('/js/cartManager.js') }}"></script>

@endsection