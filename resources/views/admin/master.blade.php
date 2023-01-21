<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - GMRE</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">
    
    {{-- CDN CSS Integrados--}}
    {{-- Boostrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    {{-- Mis Estilos --}}
    <link rel="stylesheet" href="{{  url('/static/css/admin.css?v='.time()) }}">

    {{-- ROBOTO --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    {{-- LigthBox  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    {{-- Timeline Style --}}
    {{-- <link rel="stylesheet" href="{{ url('/static/libs/jQueryTimerline/css/style.css') }}"> --}}

    {{--CDN JavaScripts Integrados  --}}
    {{-- FontAwesome --}}
    <script src="https://kit.fontawesome.com/776ed7f2a9.js" crossorigin="anonymous"></script>

    {{-- JQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- Boostrap 4 --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>


    {{-- LightBox--}}
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <script src="{{ url('/static/libs/ckeditor/ckeditor.js') }}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ url('/static/js/admin.js?v='.time()) }}"></script>
    
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
    <div class="wrapper">
        {{-- Seccion de la Izquiera - Sidebar --}}
        <div class="col1">
            @include('admin.sidebar')
        </div>

        {{-- Sección de la Derecha --}}
        <div class="col2">
            {{-- Barra de Navegación --}}
            <nav class="navbar navbar-expand-lg shadow">
                <div class="collapse navbar-collapse ml-2">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{'/admin'}}"><i class="fas fa-tachometer-alt"> Dashboard</i></a>
                        </li>
                    </ul>
                </div>
            </nav>

            {{-- Contenedor Principal --}}
            <div class="page">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb shadow">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{'/admin'}}"><i class="fas fa-tachometer-alt"> Dashboard</i></a>
                            </li>
                            @section('breadcrumb')
                            @show
                        </ol>
                    </nav>
                </div>

                {{-- Mensajes de errores --}}
                @if(Session::has('message'))
                <div class="container">
                    <div class="alert alert-{{ Session::get('typealert')}}" style="display:none;">
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
                @section('content')
                @show
            </div>
        </div>
    </div>
</body>

</html>