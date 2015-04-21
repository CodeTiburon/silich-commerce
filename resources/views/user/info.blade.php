@extends('myapp')

@section('content')

   <h1>Users</h1>

    @foreach($users as $user)

        <h2><a href="{{ action("UserController@show", [$user->id]) }}">{{ $user->name }}</a></h2>

        <div>{{ $user->role }}</div>

    @endforeach

@endsection

