@extends('admin.master')

@section('title', 'Envíos')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{'/admin/coverage'}}"><i class="fas fa-shipping-fast"> Cobertura de Envíos</i></a>
</li>

<li class="breadcrumb-item">
    <a href="{{'/admin/coverage/'.$coverage->state_id.'/cities'}}"><i class="fas fa-shipping-fast"></i> {{$coverage->getState->name}}</a>
</li>

<li class="breadcrumb-item">
    <a href="{{'/admin/coverage/city/'.$coverage->state_id.'/edit'}}"><i class="far fa-edit"></i> Editando: {{$coverage->name}}</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @if(kvfj(Auth::user()->permissions, 'coverage_add'))
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-edit"></i>Editar {{$coverage->name}}</h2>
                </div>
                <div class="inside">
                    {!!Form::open(['url'=>'admin/coverage/city/'.$coverage->id.'/edit'])!!}

                    <label for="name">Nombre:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::text('name', $coverage->name, ['class'=>'form-control']) !!}
                    </div>

                    <label for="module" class="mtop16">Estatus:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::select('status', getCoverageStatus(), $coverage->status, ['class'=>'form-select', 'min'=>1,
                        'step'=>'any']) !!}
                    </div>

                    <label for="name" class="mtop16">Valor del Envío:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::number('shipping_value', $coverage->price,
                        ['class'=>'form-control','min'=>0,'step'=>'any']) !!}
                    </div>

                    <label for="name" class="mtop16">Tiempo estimado de Entrega:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::text('days', $coverage->days, ['class'=>'form-control']) !!}
                    </div>

                    <div class="row mtop16">
                        <div class="col md-12">
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-9">
            
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-shipping-fast"></i> Información General</h2>
                </div>
                <div class="inside">
                    @if ($coverage->coverage_type == 1 )
                    <p><strong>Tipo:</strong> Ciudad</p>
                    <p><strong>Nombre:</strong> {{$coverage->name}}</p>
                    <p><strong>Departamento : </strong>{{$coverage->getState->name}}</p>
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection