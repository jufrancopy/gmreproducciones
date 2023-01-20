@extends('admin.master')

@section('title', 'Agregar Hito')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{'/admin/timelines-list/'.$profileId}}"><i class="fas fa-boxes"> Timelines</i></a>
</li>

<li class="breadcrumb-item">
    <span><i class="fas fa-plus-circle"></i> Agregar Hito</span>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar Agregar Hito</h2>
        </div>
        <div class="inside">
            {!!Form::open(['url'=>'admin/timeline/add', 'files'=>true])!!}
            <div class="row">
                {{-- Campo Oculto que contiene id del Perfil --}}
                {!! Form::hidden('profile_id', $profileId, ['class'=>'form-control']) !!}
                
                <div class="col-md-12">
                    <label for="title">Titulo:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                        </div>
                        {!! Form::text('title', null, ['class'=>'form-control']) !!}
                    </div>
                </div>
               
                <div class="col-md-6">
                    <label for="image">Imagen:</label>
                    <div class="input-group">
                        <div class="custom-file">
                            {!! Form::file('image', ['class'=>'custom-file-input', 'id'=>'customFile', 'accept'=>'image/*',
                            'lang'=>'es']) !!}
                            <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="date">Fecha:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                        </div>
                        {{ Form::date('date', $date, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>

            {{-- Tercera Fila de Inputs --}}
            <div class="row mtop16">
                <div class="col-md-12">
                    <label for="content">Descripción</label>
                    {!! Form::textarea('description', null, ['class'=>'form-control', 'id'=>'editor']) !!}
                </div>
            </div>
            {{-- Fin Tercera Fila de Inputs --}}
            
            {{-- Boton de Envio --}}
            <div class="row mtop16">
                <div class="col md-12">
                    {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                </div>
            </div>
            {{-- FIn Boton de Envio --}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection