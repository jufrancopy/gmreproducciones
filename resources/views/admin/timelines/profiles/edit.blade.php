@extends('admin.master')

@section('title', 'Editar Timeline - Perfiles')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{'/admin/timelines'}}"><i class="fas fa-boxes"> Linea de tiempo</i></a>
</li>

<li class="breadcrumb-item">
    <span>
        <i class="fas fa-edit"></i> Editar
    </span>
    
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-plus-circle"></i> Editar Linea de Tiempo</h2>
        </div>
        <div class="inside">
            {!! Form::open(['route'=>['timeline-profiles.update', $timelineProfile->id],
            'method'=>'PUT'])	!!}
            <div class="row">
                <div class="col-md-12">
                    <label for="name">Nombre:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                        </div>
                        {!! Form::text('name', $timelineProfile->name, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            {{-- Tercera Fila de Inputs --}}
            <div class="row mtop16">
                <div class="col-md-12">
                    <label for="content">Descripción</label>
                    {!! Form::textarea('description', $timelineProfile->description, ['class'=>'form-control', 'id'=>'editor']) !!}
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