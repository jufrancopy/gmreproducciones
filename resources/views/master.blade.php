<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - GMRE</title>
    <meta name="viewport" content="width=devide-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">
    <meta name="currency" content="{{Config::get('configSite.currency')}}">

    {{-- CDN CSS Integrados--}}

    {{-- Boostrap 5 - CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    --}}

    {{-- Mis Estilos --}}
    <link rel="stylesheet" href="{{  url('/static/css/style.css?v='.time()) }}">

    {{-- ROBOTO --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

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
    <script src="{{ url('/static/js/slider.js?v='.time()) }}"></script>
    <script src="{{ url('/static/js/site.js?v='.time()) }}"></script>


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


    <nav class="navbar navbar-expand-lg shadow">
        <div class="container-fluid">

            <a class="navbar-brand" href="{{url('/')}}">
                {{-- <img src="{{url('/static/images/logo.png')}}"> --}}
                <div class="btn btn-warning text-white">
                    <h1>GMRE</h1>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigationMain"
                aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>

            </button>

            <div class="collapse navbar-collapse" id="navigationMain">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{url('/')}}" class="nav-link">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/')}}" class="nav-link">
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
                        <a href="{{url('/')}}" class="nav-link">
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