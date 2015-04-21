@extends('myapp')

@section('content')
    <h1>Create a new user</h1>

    {!! Form::open(['url' => 'user']) !!}
        @include('user.form', ['submitButton' => 'Create User'])
    {!! Form::close() !!}

    @include('errors.list')

@endsection