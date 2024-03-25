@extends('master')
@section('title', 'Recuperar Contraseña')
@section('content')
    <div class="page_connect">
        <div class="box shadow">
            <div class="inside">
                {!! Form::open(['url' => '/reset']) !!}
                <div class="input-group">
                    {!! Form::email('email', $email, ['class' => 'form-control', 'required']) !!}
                    <div class="btn"><i class="fas fa-envelope-square"></i></div>
                </div>

                <div class="input-group mtop16">
                    {!! Form::number('code', null, [
                        'class' => 'form-control',
                        'required',
                        'placeholder' => 'Código de recuperación',
                    ]) !!}
                    <div class="btn"><i class="fas fa-sort-numeric-up-alt"></i></div>
                </div>

                {!! Form::submit('Recuperar Contraseña', ['class' => 'btn btn-action mtop16']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
