@extends('master')
@section('title', _sl('recover.recover'))
@section('content')
    <div class="page_connect">
        <div class="box shadow">
            <div class="inside">
                <h2 class="title"><i class="bi bi-person-circle"></i> {{ _sl('recover.title') }}</h2>
                {!! Form::open(['url' => '/reset']) !!}
                <div class="input-group">
                    {!! Form::email('email', $email, ['class' => 'form-control', 'required']) !!}
                    <div class="btn"><i class="fas fa-envelope-square"></i></div>
                </div>

                <div class="input-group mtop16">
                    {!! Form::number('code', null, [
                        'class' => 'form-control',
                        'required',
                        'placeholder' => _sl('recover.cod_recover'),
                    ]) !!}
                    <div class="btn"><i class="fas fa-sort-numeric-up-alt"></i></div>
                </div>

                {!! Form::submit(_sl('recover.title_btn'), ['class' => 'btn btn-action mtop16']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
