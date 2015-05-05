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
            <th>Options</th>
        </tr>
        @foreach($products as $product)

            <tr>
                <td><img src="{{ asset('assets/uploads/' . $product->photos()->first()['title']) }}" width="150px" height="100px"></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td><a href="{{ url('admin/products/edit', $product->id) }}">Edit</a></td>
            </tr>

        @endforeach

    </table>
@endsection