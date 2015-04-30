@extends('myapp')

@section('content')

    <h2>Products</h2>
    <div id="successAjax" style="display: none"></div>

        @foreach($products as $product)

            <h3><a href="{{ url('admin/products', $product->id) }}">{{ $product->name }}</a></h3>
                <div class="body">
                    {{ $product->descripion }}
                </div>
        @endforeach
@endsection