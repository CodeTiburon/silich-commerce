<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <!-- Temp admin css -->
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
    @yield('assets')
</head>
<body>
<div class="navbar navbar-inverse">
    <div class="container-fluid">

        <div class="navbar-header">
            <a class="navbar-brand" href="{{url('/')}}">E-commerce</a>
        </div>

        <div class="collpase navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{url('/')}}">Home</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(Auth::guest())
                <li><a href="{{url('authorize/login')}}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <li><a href="{{url('authorize/register')}}"><span class="glyphicon glyphicon-registration-mark"></span> Register</a></li>
            </ul>
            @else
                @if(\Auth::user()->isAdmin())

                            <ul class="nav navbar-nav " role="menu">
                                <li><a href="{{url('admin/categories')}}"><span class="glyphicon glyphicon-list-alt"></span> Categories</a></li>
                                <li><a href="{{ url('admin/products') }}"><span class="glyphicon glyphicon-credit-card"></span>Products</a></li>
                            </ul>

                @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/authorize/logout') }}">Logout</a></li>
                    </ul>
                </li>
            @endif
        </div>
    </div>
</div>
</div>
<div class="container">

    @include('partials.flash')


    @yield('content')
</div>
<div class="container-fluid">
    @yield('mainContent')
</div>
    @yield('footer')
<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="{{ asset('/assets/jQueryForm/jquery.form.js') }}"></script>
<script src="{{ asset('/js/index.js') }}"></script>
@yield('sources')
</body>
</html>
