@extends('connect.master')
@section('title', 'Registrarse')
@section('content')
<div class="box box_register shadow-lg">
    <div class="header">
        <a href="{{url('/')}}">
            {{-- <img src="{{url('/static/images/logo.png')}}"> --}}
            <div class="d-flex justify-content-center mt-4">
                <div class="btn btn-warning text-white">
                    <h1>GMRE</h1>
                </div>
            </div>
        </a>
    </div>

    @if(Session::has('message'))
                <div class="container">
                    <div class="alert alert-{{ Session::get('typealert') }}" style="display:none;">
                        {{ Session::get('message') }}
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
            
    <div class="inside">
        {!! Form::open(['url' => '/register']) !!}
        <label for="name">Nombre:</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user"></i></div>
            </div>
            {!! Form::text('name', null, ['class'=>'form-control', 'required']) !!}
        </div>

        <label for="lastname" class="mtop16">Apellido:</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user-tag"></i></i></div>
            </div>
            {!! Form::text('lastname', null, ['class'=>'form-control','required']) !!}
        </div>

        <label for="email" class="mtop16">Email</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-envelope-square"></i></div>
            </div>
            {!! Form::email('email', null, ['class'=>'form-control','required']) !!}
        </div>

        <label for="password" class="mtop16">Contraseña</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-key"></i></i></div>
            </div>
            {!! Form::password('password', ['class'=>'form-control','required']) !!}
        </div>

        <label for="cpassword" class="mtop16">Repetir Contraseña</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-key"></i></i></div>
            </div>
            {!! Form::password('cpassword', ['class'=>'form-control']) !!}
        </div>

        {!! Form::submit('Ingresar', ['class'=>'btn btn-success mtop16']) !!}
        {!! Form::close() !!}
            <div class="footer mtop16">
                    <a href="{{url('/login')}}">Ya tengo una clave, irme a Login</a>
                    <a href="{{url('/recovery')}}">Recupera tu Contraseña</a>
                </div>
            </div>
        </div>
    @stop