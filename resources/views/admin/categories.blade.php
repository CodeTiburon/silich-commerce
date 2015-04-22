@extends('myapp')

@section('content')

    <ul>
        @foreach($categories as $node)
            {{ $node  }}
            @endforeach
    </ul>

@endsection