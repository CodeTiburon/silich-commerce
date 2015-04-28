@extends('app')

@section('content')

    {!! Form::model($article = new \App\Articles, ['url' => 'articles'])!!}

        @include('articles.form', ['submitButton' => 'Add Article'])

    {!! Form::close() !!}

    @include('errors.list')
@endsection
