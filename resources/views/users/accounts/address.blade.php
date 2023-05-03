@extends('master')
@section('title', 'Direcciones de Entrega')
@section('content')
<div class="row mtop16">
    <div class="col-md-3">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-map-marker-alt"></i> Direcciones de Entrega</h2>
            </div>
            <div class="inside">
                {!! Form::open(['url'=>'/account/address/add']) !!}
                <div class="row">

                    <label for="name">Nombre:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>

                    <label for="module" class="mtop16">Estado:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="far fa-keyboard"></i>
                        </span>
                        {!! Form::select('state_id', $states, null,['class'=>'form-select', 'id'=>'state'])!!}
                    </div>

                    <label for="module" class="mtop16">Ciudad:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="far fa-keyboard"></i>
                        </span>
                        {!! Form::select('city_id', [], null,['class'=>'form-select', 'id'=>'address_city',
                        'required'])!!}
                    </div>

                    <label for="add1" class="mtop16">Barrio:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::text('add1', null, ['class'=>'form-control']) !!}
                    </div>

                    <label for="add2" class="mtop16">Dirección:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::text('add2', null, ['class'=>'form-control']) !!}
                    </div>

                    <label for="add3" class="mtop16">Nro de Casa:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::text('add3', null, ['class'=>'form-control']) !!}
                    </div>

                    <label for="add4" class="mtop16">Referencia:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::text('add4', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-12">
                            {!! Form::submit('Enviar', ['class'=>'btn btn-primary mtop16']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-plus-circle"></i>Mis direcciones de Entrega</h2>
            </div>
            <div class="inside">
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Departamento - Ciudad</th>
                            <th>Dirección</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::user()->getAddress as $address)
                        <tr>
                            <td>
                                <p>{{$address->name}}</p>
                            </td>
                            <td>
                                <p>
                                    {{$address->getState->name}} - {{$address->getCity->name}}
                                </p>
                                @if($address->default == 0)
                                <p><a href="{{url('/account/address/'.$address->id.'/setdefault')}}">Volver Principal</a></p>
                                @else
                                    <p><small>Dirección de Entrega Principal</small></p>
                                @endif
                            </td>
                            <td>
                                <p><strong>Barrio:</strong>
                                    {{kvfj($address->addr_info, 'add1')}}
                                </p>

                                <p><strong>Calle:</strong>
                                    {{kvfj($address->addr_info, 'add2')}}
                                </p>

                                <p><strong>Casa:</strong>
                                    {{kvfj($address->addr_info, 'add3')}}
                                </p>

                                <p>
                                    <strong>Referencias:</strong>
                                    {{kvfj($address->addr_info, 'add4')}}
                                </p>
                            </td>
                            <td>
                                @if($address->default == 0)
                                <a href="#" class="btn-delete btn_deleted" data-object="{{$address->id}}" data-action="delete" data-path="account/address">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                                @endif
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