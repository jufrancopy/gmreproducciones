<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{Config::get('configSite.name')}}</title>
    <meta name="viewport" content="width=devide-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">
    <meta name="currency" content="{{Config::get('configSite.currency')}}">
    <meta name="auth" content="{{Auth::check()}}">

    @yield('custom_meta')

    {{-- CDN CSS Integrados--}}

    {{-- Boostrap 5 - CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    --}}

    {{-- Slick - Slider --}}
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />


    {{-- Mis Estilos --}}
    <link rel="stylesheet" href="{{  url('/static/css/style.css?v='.time()) }}">

    {{-- ROBOTO --}}
    {{--
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;0,700;1,300&display=swap"
        rel="stylesheet">

    {{-- LigthBox --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    {{--CDN JavaScripts Integrados --}}
    {{-- FontAwesome --}}
    <script src="https://kit.fontawesome.com/776ed7f2a9.js" crossorigin="anonymous"></script>

    {{-- JQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- Popper --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>

    {{-- Bootstrap5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- LightBox--}}
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    {{-- <script src="{{ url('/static/libs/ckeditor/ckeditor.js') }}"></script> --}}

    {{-- Slick - Slider --}}
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script src="{{ url('/static/js/slider.js?v='.time()) }}"></script>
    <script src="{{ url('/static/js/site.js?v='.time()) }}"></script>

    {{-- SweetAlert2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- TimelineJs --}}
    {{-- <script src="{{ url('/static/libs/jQueryTimerline/js/jquery.timelinr-0.9.7.js') }}"></script> --}}
    <script>
        $(document).ready(function(){
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        });
    </script>

</head>

<body>
    {{-- Navegación --}}
    <div class="loader" id="loader">
        <div class="box">
            <div class="cart">
                <img src="{{url('/static/images/loading_carts.png')}}" alt="">
            </div>
            <div class="load">
                <div class="spinner-border text-secondary" role="status"></div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg shadow">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{url('/static/images/Logo_GMRE-03.png')}}" class="img-fluid">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigationMain"
                aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navigationMain">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{url('/')}}" class="nav-link lk-home">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/store')}}" class="nav-link lk-store lk-store_category lk-product_single">
                            <i class="fas fa-store-alt" aria-hidden="true"></i>
                            <span>Tienda</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/')}}" class="nav-link">
                            <i class="fa fa-info" aria-hidden="true"></i>
                            <span>Nosotros</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/')}}" class="nav-link">
                            <i class="far fa-envelope"></i>
                            <span>Contacto</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/cart')}}" class="nav-link lk-cart">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <span class="carnumber">0</span>
                            <span>Carrito</span>

                        </a>
                    </li>
                    @if(Auth::guest())
                    <li class="nav-item link-acc">
                        <a href="{{url('/login')}}" class="nav-link btn"><i class="far fa-user-circle"
                                aria-hidden="true"></i> Ingresar
                        </a>
                        <a href="{{url('/register')}}" class="nav-link btn"><i class="fa fa-home"
                                aria-hidden="true"></i>
                            Crear Cuenta
                        </a>
                    </li>
                    @else

                    <li class="nav-item link-acc link-user dropdown">
                        <a href="{{url('/login')}}" class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                        Bienvenido
                            data-bs-toggle="dropdown" aria-expanded="false">

                            @if(is_null(Auth::user()->avatar))
                            <img src="{{url('/static/images/avatar_default.png')}}">
                            @else
                            <img src="{{ url('/uploads_users/'.Auth::id().'/av_'.Auth::user()->avatar) }}"
                                class="circle">
                            Hola: {{ Auth::user()->name }}
                            @endif
                        </a>
                        <ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->role == 1)
                            <li>
                                <a class="dropdown-item" href="{{ url('/admin') }}">
                                    <i class="fas fa-chalkboard-teacher " aria-hidden="true"></i>
                                    Administración
                                </a>
                            </li>
                            @endif
                            <li>
                                <a class="dropdown-item" href="{{ url('/account/address') }}">
                                    <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                    Direcciones de Entregas
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/account/favorites') }}">
                                    <i class="fas fa-heart" aria-hidden="true"></i>
                                    Favoritos
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/account/edit') }}">
                                    <i class="fa fa-address-book" aria-hidden="true"></i>
                                    Detalles
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/logout') }}">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    Salir
                                </a>
                            </li>
                        </ul>
                    </li>

                    @endif
                </ul>
            </div>
        </div>
    </nav>



    {{-- Mensajes de errores --}}
    @if(Session::has('message'))
    <div class="container">
        <div class="alert alert-{{ Session::get('typealert')}} mtop16" style="display:none;">
            {{Session::get('message')}}
            @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error )
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <script>
                $('.alert').slideDown();
                    setTimeout(function(){ $('.alert').slideUp();},10000) 
            </script>
        </div>
    </div>
    @endif

    {{-- Contenido Principal --}}
    <div class="wrapper">
        <div class="container">
            @yield('content')
            @show
        </div>

    </div>

</body>

</html>