@extends('master')
@section('title', _sl('login.login'))
@section('content')
    <div class="page page_connect">
        <div class="box shadow">
            <div class="inside">
                <h2 class="title"><i class="bi bi-person-circle"></i> {{ _sl('login.title') }}</h2>
                {!! Form::open(['url' => '/login']) !!}
                <div class="input-group mb-2    ">
                    <div class="input-group">
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => _sl('login.email')]) !!}
                        <div class="btn"><i class="fas fa-envelope-square"></i></div>
                    </div>
                </div>
                <div class="input-group">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => _sl('login.password')]) !!}
                    <div class="btn"><i class="fas fa-lock"></i></div>
                </div>

                {!! Form::submit(_sl('login.login'), ['class' => 'btn btn-action w100 mtop16']) !!}
                {!! Form::close() !!}

                <div class="footer mtop16">
                    <a href="{{ url('/register') }}">{{ _sl('login.register') }}</a>
                    <a href="{{ url('/recover') }}">{{ _sl('login.recover') }}</a>
                </div>
            </div>
        </div>
    </div>

@stop
