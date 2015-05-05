@extends('app')

@section('content')

    {!! Form::model($article, ['method' => 'PATCH', 'action' => ['ArticlesController@update', $article->id]]) !!}


        @include('articles.form', ['submitButton' => 'Edit Article'])

    {!! Form::close() !!}

    @include('errors.list')
    @sou
    @endsection