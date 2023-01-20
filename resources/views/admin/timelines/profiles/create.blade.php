@extends('admin.master')

@section('title', 'Timeline - Perfiles')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{route('timeline-profiles.index')}}">
        <i class="fas fa-boxes"> Timelines</i>
    </a>
</li>

<li class="breadcrumb-item">
    <span>
        <i class="fas fa-plus-circle"></i> Nuevo
    </span>
    
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-plus-circle"> Nueva Linea de Tiempo</i></h2>
        </div>
        <div class="inside">
            {!!Form::open(['route'=>'timeline-profiles.store', 'files'=>true])!!}
            <div class="row">
                <div class="col-md-12">
                    <label for="name">Nombre:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
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