@extends('myapp')

@section('content')


    <h1>Create a new user</h1>

    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id]]) !!}

        @include('user.form', ['submitButton' => 'Update user'])

    {!! Form::close() !!}

    @include('errors.list')


@endsection