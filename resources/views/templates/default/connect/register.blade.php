@extends('master')
@section('title', 'Registrarse')
@section('content')
    <div class="page page_connect">
        <div class="box shadow">
            <div class="inside">
                <h2 class="title"><i class="bi bi-person-circle"></i> Registrarse</h2>
                {!! Form::open(['url' => '/register']) !!}
                <div class="input-group">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre']) !!}
                    <div class="btn"><i class="fas fa-user"></i></div>
                </div>

                <div class="input-group mtop16">
                    {!! Form::text('lastname', null, ['class' => 'form-control', 'required', 'placeholder' => 'Apellido']) !!}
                    <div class="btn"><i class="fas fa-user-tag"></i></div>
                </div>

                <div class="input-group mtop16">
                    {!! Form::email('email', null, ['class' => 'form-control', 'required', 'placeholder' => 'Correo']) !!}
                    <div class="btn"><i class="fas fa-envelope-square"></i></div>
                </div>

                <div class="input-group mtop16">
                    {!! Form::password('password', ['class' => 'form-control', 'required', 'placeholder' => 'Contraseña']) !!}
                    <div class="btn"><i class="fas fa-key"></i></div>
                </div>
                <div class="input-group mtop16">
                    {!! Form::password('cpassword', ['class' => 'form-control', 'placeholder' => 'Repetir contraseña']) !!}
                    <div class="btn"><i class="fas fa-key"></i></div>
                </div>

                {!! Form::submit('Registrarme', ['class' => 'btn btn-action mtop16 w100']) !!}
                {!! Form::close() !!}
                <div class="footer mtop16">
                    <a href="{{ url('/login') }}">Ya tengo una clave, irme a Login</a>
                    <a href="{{ url('/recover') }}">Recupera tu Contraseña</a>
                </div>
            </div>
        </div>
    </div>
@stop
