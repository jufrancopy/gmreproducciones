@extends('master')
@section('title', 'Editar Información')
@section('content')
    <div class="page">
        <div class="container">
            <div class="title">
                <h2><i class="bi bi-gear"></i> Mi Información</h2>
            </div>
            <div class="row mtop16">
                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="bi bi-person-circle"></i> Editar Avatar</h2>
                        </div>
                        <div class="inside">
                            <div class="edit_avatar">
                                {!! Form::open(['url' => 'account/edit/avatar', 'id' => 'form_avatar_change', 'files' => true]) !!}
                                <a href="" id="btn_avatar_edit">
                                    <div class="overlay" id="avatar_change_overlay">
                                        <i class="bi bi-camera"></i>
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
                            <h2 class="title"><i class="bi bi-shield-lock"></i> Cambiar Contraseña</h2>
                        </div>
                        <div class="inside">
                            {!! Form::open(['url' => '/account/edit/password']) !!}
                            <div class="input-group">
                                {!! Form::password('apassword', ['class' => 'form-control', 'placeholder' => 'Contraseña Actual']) !!}
                                <div class="btn mr16"><i class="fas fa-keyboard"></i></div>
                            </div>

                            <div class="input-group mtop16">
                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Nueva Contraseña']) !!}
                                <div class="btn mr16"><i class="fas fa-keyboard"></i></div>
                            </div>

                            <div class="input-group mtop16">
                                {!! Form::password('cpassword', ['class' => 'form-control', 'placeholder' => 'Repetir Contraseña']) !!}
                                <div class="btn mr16"><i class="fas fa-keyboard"></i></div>
                            </div>

                            <div class="row mtop16">
                                <div class="col-md-12">
                                    {!! Form::submit('Actualizar Contraseña', ['class' => 'btn btn-action mtop16 w100']) !!}
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="bi bi-person-badge"></i> Editar Información</h2>
                        </div>
                        <div class="inside">
                            {!! Form::open(['url' => '/account/edit/info']) !!}
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name" class="pleft24">Nombre:</label>
                                    <div class="input-group">
                                        {!! Form::text('name', Auth::user()->name, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                                        <div class="btn"><i class="fas fa-keyboard"></i></div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="lastname" class="pleft24 mtop16">Apellido:</label>
                                    <div class="input-group">
                                        {!! Form::text('lastname', Auth::user()->lastname, ['class' => 'form-control']) !!}
                                        <div class="btn"><i class="fas fa-keyboard"></i></div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="email" class="pleft24 mtop16">Correo:</label>
                                    <div class="input-group">
                                        {!! Form::text('email', Auth::user()->email, ['class' => 'form-control', 'disabled']) !!}
                                        <div class="btn"><i class="fas fa-keyboard"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mtop16">
                                <div class="col-md-4">
                                    <label for="email" class="pleft24 mtop16">Teléfono:</label>
                                    <div class="input-group">
                                        {!! Form::number('phone', Auth::user()->phone, ['class' => 'form-control']) !!}
                                        <div class="btn"><i class="fas fa-keyboard"></i></div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <label for="module" class="pleft24 mtop16">Fecha de Nacimiento (Día - Mes -
                                        Año)</label>
                                    <div class="row">
                                        <div class="col-md-4 mtop16">
                                            {!! Form::number('day', $birthday[2], [
                                                'class' => 'form-control',
                                                'min' => 01,
                                                'max' => 31,
                                                'required',
                                                'placeholder' => '11',
                                            ]) !!}
                                        </div>
                                        <div class="col-md-4">
                                            {!! Form::select('month', getMonths('list', null), $birthday[1], [
                                                'class' => 'form-select',
                                                'placeholder' => 'Noviembre',
                                            ]) !!}
                                        </div>
                                        <div class="col-md-4">
                                            {!! Form::number('year', $birthday[0], [
                                                'class' => 'form-control',
                                                'min' => getUserYears()[1],
                                                'max' => getUserYears()[0],
                                                'required',
                                                'placeholder' => '1981',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row mtop16">
                                    <div class="col-md-4">
                                        <label for="module" class="pleft24 mtop16">Género</label>
                                        {!! Form::select('gender', ['0' => 'Indefinido', '1' => 'Masculino', '2' => 'Femenino'], Auth::user()->gender, [
                                            'class' => 'form-select',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="row mtop16">
                                    <div class="col-md-12">
                                        {!! Form::submit('Enviar', ['class' => 'btn btn-action mtop16']) !!}
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
