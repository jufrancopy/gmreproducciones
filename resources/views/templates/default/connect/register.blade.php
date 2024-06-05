@extends('master')
@section('title', _sl('register.register'))
@section('content')
    <div class="page page_connect">
        <div class="box shadow">
            <div class="inside">
                <h2 class="title"><i class="bi bi-person-circle"></i> {{ _sl('register.title') }}</h2>
                {!! Form::open(['url' => '/register']) !!}
                <div class="input-group">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => _sl('register.name')]) !!}
                    <div class="btn"><i class="fas fa-user"></i></div>
                </div>

                <div class="input-group mtop16">
                    {!! Form::text('lastname', null, [
                        'class' => 'form-control',
                        'required',
                        'placeholder' => _sl('register.lastname'),
                    ]) !!}
                    <div class="btn"><i class="fas fa-user-tag"></i></div>
                </div>

                <div class="input-group mtop16">
                    {!! Form::email('email', null, ['class' => 'form-control', 'required', 'placeholder' => _sl('register.email')]) !!}
                    <div class="btn"><i class="fas fa-envelope-square"></i></div>
                </div>

                <div class="input-group mtop16">
                    {!! Form::password('password', [
                        'class' => 'form-control',
                        'required',
                        'placeholder' => _sl('register.password'),
                    ]) !!}
                    <div class="btn"><i class="fas fa-key"></i></div>
                </div>
                <div class="input-group mtop16">
                    {!! Form::password('cpassword', ['class' => 'form-control', 'placeholder' => _sl('register.cpassword')]) !!}
                    <div class="btn"><i class="fas fa-key"></i></div>
                </div>

                {!! Form::submit(_sl('register.register'), ['class' => 'btn btn-action mtop16 w100']) !!}
                {!! Form::close() !!}
                <div class="footer mtop16">
                    <a href="{{ url('/login') }}">{{ _sl('register.to_login') }}</a>
                    <a href="{{ url('/recover') }}">{{ _sl('register.recover') }}</a>
                </div>
            </div>
        </div>
    </div>
@stop
