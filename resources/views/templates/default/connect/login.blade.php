@extends('master')
@section('title', 'Login')
@section('content')
    <div class="page page_connect">
        <div class="box shadow">
            <div class="inside">
                <h2 class="title"><i class="bi bi-person-circle"></i> Ingrese sus credenciales</h2>
                {!! Form::open(['url' => '/login']) !!}
                <div class="input-group mb-2    ">
                    <div class="input-group">
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Correo Electrónico']) !!}
                        <div class="btn"><i class="fas fa-envelope-square"></i></div>
                    </div>
                </div>
                <div class="input-group">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña']) !!}
                    <div class="btn"><i class="fas fa-lock"></i></div>
                </div>

                {!! Form::submit('Ingresar', ['class' => 'btn btn-action w100 mtop16']) !!}
                {!! Form::close() !!}

                <div class="footer mtop16">
                    <a href="{{ url('/register') }}">Registrarse</a>
                    <a href="{{ url('/recover') }}">Recupera tu Contraseña</a>
                </div>
            </div>
        </div>
    </div>

@stop
