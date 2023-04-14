@extends('admin.master')

@section('title', 'Envíos')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{'/admin/coverage'}}"><i class="fas fa-shipping-fast"> Cobertura de Envíos</i></a>
</li>

<li class="breadcrumb-item">
    <a href="{{'/admin/coverage/'.$state->id.'/cities'}}"><i class="fas fa-list"> Ciudades de: {{$state->name}}</i></a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @if(kvfj(Auth::user()->permissions, 'coverage_add'))
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i>Agregar Ciudad a {{$state->name}}</h2>
                </div>
                <div class="inside">
                    {!!Form::open(['url'=>'admin/coverage/city/add/'])!!}
                    {!! Form::hidden('state_id', $id) !!}

                    <label for="name">Nombre:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>

                    

                    <label for="name" class="mtop16">Valor del Envío:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::number('shipping_value', Config::get('configSite.shipping_default_value'),
                        ['class'=>'form-control','min'=>0,'step'=>'any']) !!}
                    </div>

                    <label for="name" class="mtop16">Tiempo estimado de Entrega:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::text('days', 0, ['class'=>'form-control']) !!}
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
                    <h2 class="title"><i class="fas fa-list"></i> Ciudades de: {{$state->name}}</h2>
                </div>

                <div class="inside">
                    <table class="table mtop16">
                        <thead>
                            <tr>
                                <th>Estado</th>
                                <th>Departamento</th>
                                <th>Tiempo Entrega</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cities as $city)
                            <tr>
                                <td>{{getCoverageStatus($city->status)}}</td>
                                <td>{{$city->name}}</td>
                                <td>{{$city->days}} días</td>
                                <td>
                                    <div class="opts">
                                        @if(kvfj(Auth::user()->permissions, 'coverage_edit'))

                                        <a href="{{url('/admin/coverage/city/'.$city->id.'/edit')}}" data-toogle="tooltip"
                                            data-toggle="tooltip" data-placement="top" title="Editar" class="edit"><i
                                                class="fas fa-edit"></i>
                                        </a>

                                        @endif
                                        @if(kvfj(Auth::user()->permissions, 'coverage_delete'))
                                        <a href="{{ url('/admin/product/'.$city->id.'/delete') }}" data-action="delete"
                                            data-path="admin/coverage" data-object={{ $city->id
                                            }} data-toggle="tooltip"
                                            data-placement="top" title="Eliminar" class="btn_deleted deleted"><i
                                                class="fas fa-trash-alt"></i>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection