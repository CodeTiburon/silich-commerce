@extends('myapp')

@section('content')

    <h2>Products</h2>
    <form action="{{ url('admin/products/create') }}" method="GET">
        <button type="submit" value="Create New Product" class="btn btn-primary">Create New Product</button>
    </form>
    <div id="successAjax" style="display: none"></div>

    <table class="table">
        <caption>Products</caption>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Options</th>
        </tr>
        @foreach($products as $product)

            <tr>
                <td><img src="{{ empty($product->photos()
                ->where('id', '=', $product->photo_id)
                ->first()['title']) ? asset('assets/uploads/no-thumb.png')
                :$product->photos()->where('id', '=', $product->photo_id)->first()['title']}}" width="150px" height="100px"></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td><a href="{{ url('admin/products/edit', $product->id) }}">Edit</a></td>
            </tr>

        @endforeach

    </table>
@endsection