@extends('admin.master')

@section('title', 'Productos')

@section('breadcrumb')

<li class="breadcrumb-item">
    <i class="fa fa-cogs"> Productos</i>
</li>
@endsection

@section('content')
<div class="container-fluid">
    {!! Form::open(['url' => 'admin/settings']) !!}

    {{-- Row I --}}
    <div class="row">
        <div class="col-md-4 d-flex">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title">
                        <i class="fa fa-cogs"> Configuraciones Generales</i>
                    </h2>
                </div>
                <div class="inside">
                    <label for="name" class="mtop16">Nombre de la tienda:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="far fa-keyboard"></div>
                        </span>
                        {!! Form::text('name', Config::get('configSite.name'), ['class'
                        =>'form-control','required'])!!}
                    </div>


                    <label for="website" class="mtop16">Sitio Web:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="far fa-keyboard"></div>
                        </span>
                        {!! Form::text('website', Config::get('configSite.website'), ['class'
                        =>'form-control','required'])!!}
                    </div>

                    <label for="name" class="mtop16">Teléfono:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="far fa-keyboard"></div>
                        </span>
                        {!! Form::number('phone', Config::get('configSite.phone'), ['class' =>'form-control'])!!}

                    </div>

                    <label for="email_from" class="mtop16">Correo Electrónico Remitente:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="far fa-keyboard"></div>
                        </span>
                        {!! Form::email('email_from', Config::get('configSite.email_from'), ['class'
                        =>'form-control'])!!}
                    </div>

                    <label for="name" class="mtop16">Modo mantenimiento:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="far fa-keyboard"></div>
                        </span>
                        {!!Form::select('maintenance_mode',['0'=>'Inactivo','1'=>'Activo'],Config::get('configSite.maintenance_mode'),['class'
                        => 'form-select'])!!}

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title">
                        <i class="fa fa-coins"> Monedas y Precios</i>
                    </h2>
                </div>
                <div class="inside">

                    <label for="currency" class="mtop16">Simbolo:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="far fa-keyboard"></div>
                        </span>
                        {!! Form::text('currency', Config::get('configSite.currency'), ['class'
                        =>'form-control','required'])!!}
                    </div>

                    <label for="name" class="mtop16">Monto Mínimo de Compra:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="far fa-keyboard"></div>
                        </span>
                        {!!Form::number('purchase_min_amount',Config::get('configSite.purchase_min_amount'),['class'=>
                        'form-select', 'min'=>1, 'required'])!!}
                    </div>

                    <label class="mtop16">Valor del envío: </label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="far fa-keyboard"></div>
                        </span>
                        {!!
                        Form::number('shipping_default_value',Config::get('configSite.shipping_default_value'),
                        ['class' =>'form-control','required','min'=>1])!!}
                    </div>


                    <label class="mtop16">Monto Mínimo para Envío gratis:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="shipping_amount_min">
                            <div class="far fa-keyboard"></div>
                        </span>
                        {!!
                        Form::number('shipping_amount_min',Config::get('configSite.shipping_amount_min'),
                        ['class' =>'form-control','required','min'=>0])!!}
                    </div>


                    <label class="mtop16">Costo de Envío</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="far fa-keyboard"></div>
                        </span>
                        {!! Form::select('shipping_method',
                        getShippingMethod(),Config::get('configSite.shipping_method'), ['class'
                        =>'form-select','required'])!!}
                    </div>

                    <label for="to_go" class="mtop16">Ordenes To Go:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-map-pin"></i>
                        </span>
                        {!! Form::select('to_go',
                        getEnableOrNotEnable(),Config::get('configSite.to_go'), ['class'
                        =>'form-select'])!!}
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4 d-flex">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title">
                        <i class="fa fa-wifi"> Redes Sociales</i>
                    </h2>
                </div>
                <div class="inside">
                    <label for="social_facebook" class="mtop16">Facebook:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="fab fa-facebook"></div>
                        </span>
                        {!! Form::text('social_facebook', Config::get('configSite.social_facebook'), ['class'
                        =>'form-control', 'required'])!!}
                    </div>

                    <label for="social_instagram" class="mtop16">Instagram:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="fab fa-instagram"></div>
                        </span>
                        {!! Form::text('social_instagram', Config::get('configSite.social_instagram'), ['class'
                        =>'form-control', 'required'])!!}
                    </div>

                    <label for="social_twitter" class="mtop16">Twitter:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="fab fa-twitter"></div>
                        </span>
                        {!! Form::text('social_twitter', Config::get('configSite.social_twitter'), ['class'
                        =>'form-control', 'required'])!!}
                    </div>

                    <label for="social_youtube" class="mtop16">Yotube:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="fab fa-youtube"></div>
                        </span>
                        {!! Form::text('social_youtube', Config::get('configSite.social_youtube'), ['class'
                        =>'form-control', 'required'])!!}
                    </div>

                    <label for="social_whatsapp" class="mtop16">Whatsapp:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="fab fa-whatsapp"></div>
                        </span>
                        {!! Form::text('social_whatsapp', Config::get('configSite.social_whatsapp'), ['class'
                        =>'form-control', 'required'])!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Row I --}}

    {{-- Row II --}}
    <div class="row mtop16">
        <div class="col-md-4 d-flex">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title">
                        <i class="fas fa-wallet"> Pagos e Integración</i>
                    </h2>
                </div>
                <div class="inside">
                    <label for="payment_method_cash" class="mtop16">Pagos en Efectivo:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-cash-register"></i>
                        </span>
                        {!! Form::select('payment_method_cash',
                        getEnableOrNotEnable(),Config::get('configSite.payment_method_cash'), ['class'
                        =>'form-select'])!!}
                    </div>

                    <label for="payment_method_transfer" class="mtop16">Transferencia Bancaria:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-exchange-alt"></i>
                        </span>
                        {!! Form::select('payment_method_transfer',
                        getEnableOrNotEnable(),Config::get('configSite.payment_method_transfer'),
                        ['class'=>'form-select'])!!}
                    </div>

                    <label for="payment_method_transfer_accounts_bank" class="mtop16">Mensaje:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-exchange-alt"></i>
                        </span>
                        {!! Form::textarea('payment_method_transfer',Config::get('configSite.upload_server_path'), ['class'
                        =>'form-control'])!!}
                    </div>

                    <label for="payment_method_paypal" class="mtop16">Paypal:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fab fa-paypal"></i>
                        </span>
                        {!! Form::select('payment_method_paypal',
                        getEnableOrNotEnable(),Config::get('configSite.payment_method_paypal'), ['class'
                        =>'form-select'])!!}
                    </div>

                    <label for="payment_method_credit_card" class="mtop16">Tarjeta de Crédito:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-credit-card"></i>
                        </span>
                        {!! Form::select('payment_method_credit_card',
                        getEnableOrNotEnable(),Config::get('configSite.payment_method_credit_card'), ['class'
                        =>'form-select'])!!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title">
                        <i class="fa fa-file"> Paginación</i>
                    </h2>
                </div>
                <div class="inside">
                    <label for="product_per_page" class="mtop16">Productos visibles:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="far fa-keyboard"></div>
                        </span>
                        {!! Form::number('product_per_page', Config::get('configSite.product_per_page'), ['class'
                        =>'form-control','required', 'min'=>1, 'required'])!!}
                    </div>

                    <label for="product_per_page_random" class="mtop16">Productos a mostrar por página (Random):</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <div class="far fa-keyboard"></div>
                        </span>
                        {!! Form::number('product_per_page_random',Config::get('configSite.product_per_page_random'),
                        ['class' =>'form-control','required',
                        'min'=>1, 'required'])!!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title">
                        <i class="fab fa-linux"> Servidor</i>
                    </h2>
                </div>
                <div class="inside">
                    <label for="upload_server_path" class="mtop16">Upload Server Path:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="far fa-keyboard"></i>
                        </span>
                        {!! Form::text('upload_server_path',Config::get('configSite.upload_server_path'), ['class'
                        =>'form-control', 'required'])!!}
                    </div>

                    <label for="upload_server_user_path" class="mtop16"> Upload Server User Path:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="far fa-keyboard"></i>
                        </span>
                        {!! Form::text('upload_server_user_path',Config::get('configSite.upload_server_user_path'),
                        ['class'
                        =>'form-control'])!!}
                    </div>

                    <label for="server_webapp_path" class="mtop16"> Path webapp: </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="far fa-keyboard"></i>
                        </span>
                        {!! Form::text('server_webapp_path',Config::get('configSite.server_webapp_path'),
                        ['class'
                        =>'form-control'])!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Row II --}}

    {{-- Row III --}}
    <div class="row mtop16">
        <div class="col md-12">
            <div class="panel shadow">
                <div class="inside">
                    {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                </div>
            </div>
        </div>
    </div>
    {{-- End Row III --}}

    {!! Form::close() !!}


    @endsection