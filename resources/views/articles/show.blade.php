@extends('myapp')

@section('content')




        <h1>{{ $articles->title }}</h1>
        <article>

            <div class="body">
                {{ $articles->body }}
            </div>

        </article>



@endsection

