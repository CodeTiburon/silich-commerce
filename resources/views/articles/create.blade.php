@extends('app')

@section('content')

    {!! Form::open(['url' => 'articles'])!!}

        @include('articles.form', ['submitButton' => 'Add Article'])

    {!! Form::close() !!}

    @include('errors.list')
@endsection
