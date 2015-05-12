@extends('myapp')

@section('assets')
    <link rel="stylesheet" href="{{ asset('/assets/fancyBox/source/jquery.fancybox.css?v=2.1.5') }}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset('/assets/fancyBox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5') }}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset('/assets/fancyBox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7') }}" type="text/css" media="screen" />
@endsection

@section('content')
    <a type="button" class="btn btn-default" href="/">Back to product selection</a>
    <div class="col-sm-8">
        @if($mainPhoto == null)
            <div class="form-group">
                <img id="noImage" src="{{ asset('assets/uploads/no-thumb.png') }}" width="300px" height="250px"/>
            </div>
        @else
        <a class="fancybox" data-fancybox-group="gallery" href="{{ $mainPhoto->title }}" width ="300px" height="200px">
            <img id="mainPhoto" src="{{ $mainPhoto->title }}" alt="" width="300px" height="200px" data-product-id="{{ $product->id }}" />
        </a>
        <div class="gallery">
        @foreach($photos as $photo)
            <?php if($photo->title == $mainPhoto->title) {
                continue;
            } ?>
        <a class="fancybox" data-fancybox-group="gallery" href="{{ $photo->title }}">
            <img src="{{ $photo->title }}" alt="" width="100" height="80" />
        </a>

        @endforeach
        </div>
    </div>
    @endif
    <div class="col-sm-4">
        <h3> {{ $product->name }}</h3>
        <p> Description {{ $product->description }}</p>
        Price:
        <p class="priceColumn"> {{ $product->price }} $</p>
    </div>

@endsection

@section('sources')
    <script type="text/javascript" src="{{ asset('/assets/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/fancyBox/source/jquery.fancybox.pack.js?v=2.1.5') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/elevateZoom/jquery.elevatezoom.js') }}"></script>

    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <script type="text/javascript" src="{{ asset('/assets/fancyBox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/fancyBox/source/helpers/jquery.fancybox-media.js?v=1.0.6') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/fancyBox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7') }}"></script>
    <script src="{{ asset('/js/userProductView.js') }}"></script>
@endsection