@extends('admin.master')

@section('title', 'Productos')

@section('breadcrumb')

<li class="breadcrumb-item">
    <i class="fa fa-cogs"> Productos</i>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title">
                <i class="fa fa-cogs"> Configuraciones</i>
            </h2>
        </div>
        <div class="inside">
            {!! Form::open(['url' => 'admin/settings']) !!}

            <div class="row">
                <div class="col-md-4">
                    <label for="name">Nombre de la tienda:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="far fa-keyboard"></div>
                        </span>
                        {!! Form::text('name', Config::get('configSite.name'), ['class' =>'form-control','required'])!!}
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="name">Moneda:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="far fa-keyboard"></div>
                        </span>
                        {!! Form::text('currency', Config::get('configSite.currency'), ['class'
                        =>'form-control','required'])!!}
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="name">Teléfono:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="far fa-keyboard"></div>
                        </span>
                        {!! Form::text('phone', Config::get('configSite.phone'), ['class' =>'form-control'])!!}
                    </div>
                </div>

                <div class="row mtop16">
                    <div class="col-md-4">
                        <label for="name">Ubicaciones:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <div class="far fa-keyboard"></div>
                            </span>
                            {!! Form::text('map', Config::get('configSite.map'), ['class' =>'form-control'])!!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="name">Modo mantenimiento:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <div class="far fa-keyboard"></div>
                            </span>
                            {!!Form::select('maintenance_mode',['0'=>'Inactivo','1'=>'Activo'],Config::get('configSite.maintenance_mode'),['class'
                            => 'form-select'])!!}

                        </div>
                    </div>
                </div>

                <div class="row mtop16">
                    <div class="col-md-4">
                        <label for="product_per_page">Productos visibles:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <div class="far fa-keyboard"></div>
                            </span>
                            {!! Form::number('product_per_page', Config::get('configSite.product_per_page'), ['class'
                            =>'form-control','required', 'min'=>1, 'required'])!!}
                        </div>
                    </div>
                </div>

                <div class="row mtop16">
                    <div class="col-md-4">
                        <label for="product_per_page_random">Productos a mostrar por página (Random):</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <div class="far fa-keyboard"></div>
                            </span>
                            {!! Form::number('product_per_page_random',
                            Config::get('configSite.product_per_page_random'), ['class' =>'form-control','required',
                            'min'=>1, 'required'])!!}
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mtop16">
                    <div class="col-md-4">
                        <label for="product_per_page_random">Costo de Envío</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <div class="far fa-keyboard"></div>
                            </span>
                            {!! Form::select('shipping_method', getShippingMethod(),Config::get('configSite.shipping_method'), ['class' =>'form-control','required'])!!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="product_per_page_random">Valor por defecto del envío</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <div class="far fa-keyboard"></div>
                            </span>
                            {!! Form::number('shipping_default_value',Config::get('configSite.shipping_default_value'), ['class' =>'form-control','required','min'=>1])!!}
                        </div>
                    </div>
                </div>

                <div class="row mtop16">
                    <div class="col md-12">
                        {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                    </div>
                </div>

            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection