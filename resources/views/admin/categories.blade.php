@extends('myapp')

@section('content')

    <ul>
        @foreach($categories as $node)
             <?php echo Auth::user()->renderNode($node); ?>
        @endforeach
    </ul>
    <div id ='test'>hello</div>
@endsection

@section('sources')
    <script src="{{ asset('/js/adminAddDelete.js') }}"></script>
@endsection