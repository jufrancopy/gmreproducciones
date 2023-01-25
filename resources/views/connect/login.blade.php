@extends('connect.master')
@section('title', 'Login')
@section('content')
<div class="box box_login shadow-lg">
    <div class="header">
        <a href="{{url('/')}}">
            <img src="{{url('/static/images/Logo_GMRE-03.png')}}" class="img-fluid">
        </a>
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
    </div>
    <div class="inside">
        {!! Form::open(['url' => '/login']) !!}
        <label for="email">Correo Electrónico</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-envelope-square"></i></div>
            </div>
            {!! Form::email('email', null, ['class'=>'form-control']) !!}
        </div>

        <label for="password" class="mtop16">Contraseña</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-key"></i></i></div>
            </div>
            {!! Form::password('password', ['class'=>'form-control']) !!}
        </div>

        {!! Form::submit('Ingresar', ['class'=>'btn btn-success mtop16']) !!}
        {!! Form::close() !!}

        <div class="footer mtop16">
            <a href="{{url('/register')}}">Registrarse</a>
            <a href="{{url('/recover')}}">Recupera tu Contraseña</a>
        </div>
    </div>
</div>
@stop