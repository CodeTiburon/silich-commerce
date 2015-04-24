@extends('myapp')

@section('content')

    <ul>
        @foreach($categories as $node)
             <?php echo \MyHelperFacade::renderNode($node); ?>
        @endforeach
    </ul>
    <div id ='addWindow'>hello</div>
@endsection

@section('sources')
    <script src="{{ asset('/js/adminAddDelete.js') }}"></script>
@endsection