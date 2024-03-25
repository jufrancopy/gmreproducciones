@extends('master')
@section('title', 'Recuperar Contraseña')
@section('content')
    <div class="page page_connect">
        <div class="box shadow">
            <div class="inside">
                <h2 class="title"><i class="bi bi-person-circle"></i> Recuperar mi contraseña</h2>
                {!! Form::open(['url' => '/recover']) !!}
                <div class="input-group">
                    {!! Form::email('email', null, ['class' => 'form-control', 'required', 'placeholder' => 'Ingrese su correo']) !!}
                    <div class="btn"><i class="fas fa-envelope-square"></i></div>
                </div>

                {!! Form::submit('Recuperar Contraseña', ['class' => 'btn btn-action mtop16']) !!}
                {!! Form::close() !!}
                <div class="footer mtop16">
                    <a href="{{ url('/register') }}">Registrarse</a>
                    <a href="{{ url('/login') }}">Ingresar a mi cuenta</a>
                </div>
            </div>
        </div>
    </div>
@stop
