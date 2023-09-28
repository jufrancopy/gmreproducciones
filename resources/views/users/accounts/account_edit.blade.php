@extends('master')
@section('title', 'Editar Perfil')
@section('content')
    <div class="row mtop16">
        <div class="col-md-4">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-user"></i> Editar Avatar</h2>
                </div>
                <div class="inside">
                    <div class="edit_avatar">
                        {!! Form::open(['url' => 'account/edit/avatar', 'id' => 'form_avatar_change', 'files' => true]) !!}
                        <a href="" id="btn_avatar_edit">
                            <div class="overlay" id="avatar_change_overlay">
                                <i class="fas fa-camera"></i>
                            </div>
                            @if (is_null(Auth::user()->avatar))
                                <img src="{{ url('/static/images/avatar_default.png') }}">
                        </a>
                    @else
                        <img src="{{ getUrlFileFromUploads(Auth::user()->avatar) }}">
                        @endif
                        </a>
                        {!! Form::file('avatar', ['id' => 'input_file_avatar', 'accept' => 'image/*', 'class' => 'form-control']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="panel shadow mtop16">
                <div class="header">
                    <h2 class="title"><i class="fas fa-fingerprint"></i> Cambiar Contraseña</h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url' => '/account/edit/password']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <label for="apassword">Contraseña Actual:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-keyboard"></i>
                                </span>

                                {!! Form::password('apassword', ['class' => 'form-control']) !!}
                            </div>

                        </div>
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-12">
                            <label for="apassword">Nueva Contraseña:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-keyboard"></i>
                                </span>
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-12">
                            <label for="cpassword">Confirmar Contraseña:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-keyboard"></i>
                                </span>
                                {!! Form::password('cpassword', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-12">
                            {!! Form::submit('Actualizar Contraseña', ['class' => 'form-control btn btn-primary']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-address-card"></i> Editar Información</h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url' => '/account/edit/info']) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-keyboard"></i>
                                </span>

                                {!! Form::text('name', Auth::user()->name, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="lastname">Apellido:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-keyboard"></i>
                                </span>

                                {!! Form::text('lastname', Auth::user()->lastname, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="email">Correo:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-keyboard"></i>
                                </span>

                                {!! Form::text('email', Auth::user()->email, ['class' => 'form-control', 'disabled']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-4">
                            <label for="email">Teléfono:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-keyboard"></i>
                                </span>

                                {!! Form::number('phone', Auth::user()->phone, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-8">
                            <label for="module">Fecha de Nacimiento (Día - Mes - Año)</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::number('day', $birthday[2], [
                                    'class' => 'form-control',
                                    'min' => 01,
                                    'max' => 31,
                                    'required',
                                    'placeholder' => '11',
                                ]) !!}
                                {!! Form::select('month', getMonths('list', null), $birthday[1], [
                                    'class' => 'form-select',
                                    'placeholder' => 'Noviembre',
                                ]) !!}
                                {!! Form::number('year', $birthday[0], [
                                    'class' => 'form-control',
                                    'min' => getUserYears()[1],
                                    'max' => getUserYears()[0],
                                    'required',
                                    'placeholder' => '1981',
                                ]) !!}

                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-4">
                                <label for="module">Género</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="far fa-keyboard"></i>
                                    </span>
                                    {!! Form::select('gender', ['0' => 'Indefinido', '1' => 'Masculino', '2' => 'Femenino'], Auth::user()->gender, [
                                        'class' => 'form-select',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mtop16">
                            <div class="col-md-12">
                                {!! Form::submit('Enviar', ['class' => 'btn btn-primary mtop16']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
