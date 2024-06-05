@extends('master')
@section('title', _sl('recover.recover'))
@section('content')
    <div class="page page_connect">
        <div class="box shadow">
            <div class="inside">
                <h2 class="title"><i class="bi bi-person-circle"></i> {{ _sl('recover.title') }}</h2>
                {!! Form::open(['url' => '/recover']) !!}
                <div class="input-group">
                    {!! Form::email('email', null, ['class' => 'form-control', 'required', 'placeholder' => _sl('recover.email')]) !!}
                    <div class="btn"><i class="fas fa-envelope-square"></i></div>
                </div>

                {!! Form::submit('Recuperar Contraseña', ['class' => 'btn btn-action mtop16']) !!}
                {!! Form::close() !!}
                <div class="footer mtop16">
                    <a href="{{ url('/register') }}">{{ _sl('recover.register') }}</a>
                    <a href="{{ url('/login') }}">{{ _sl('recover.login') }}</a>
                </div>
            </div>
        </div>
    </div>
@stop
