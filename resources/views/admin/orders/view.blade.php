@extends('admin.master')
@section('title', 'Órden #' . $order->o_number)
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/orders/all/all') }}"><i class="fas fa-clipboard-list"></i> Órdenes</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/orders/all/all') }}"><i class="fas fa-clipboard-list"></i> Órden # {{ $order->o_number }}</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="order">
            <div class="row">
                {{-- Col Nro 1 --}}
                <div class="col-md-3">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="far fa-user-circle"></i> Usuario </h2>
                        </div>
                        <div class="inside">
                            <div class="profile">
                                <div class="photo">
                                    @if (is_null($order->getUser->avatar))
                                        <img src="{{ url('static/images/avatar_default.png') }}"
                                            class="img-fluid rounded-circle">
                                    @else
                                        <img src="{{ getUrlFileFromUploads($order->getUser->avatar) }}"
                                            class="img-fluid rounded-circle">
                                    @endif
                                </div>

                                <div class="info mtop16">
                                    <ul>
                                        <li><i class="far fa-user-circle"></i> Nombre: {{ $order->getUser->full_name }}
                                        </li>
                                        <li><i class="far fa-envelope-open"></i> Correo: {{ $order->getUser->email }} </li>
                                        @if ($order->getUser->phone)
                                            <li><i class="fas fa-phone"></i> Teléfono: {{ $order->getUser->phone }} </li>
                                        @endif
                                    </ul>
                                    <a href="{{ '/admin/user/' . $order->user_id . '/view' }}"
                                        class="btn btn-primary btn-sm mtop16">Ver usuario
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel shadow mtop16">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-map-marker"></i> Tipo de Órden </h2>
                        </div>
                        <div class="inside">
                            @if ($order->o_type == '0')
                                <p><strong>Estado: </strong> {{ $order->getUserAddress->getState->name }} </p>
                                <p><strong>Ciudad: </strong> {{ $order->getUserAddress->getCity->name }} </p>
                                <p><strong>Barrio:
                                    </strong>{{ kvfj($order->getUserAddress->addr_info, 'add1') }}
                                </p>
                                <p><strong>Dirección: </strong>
                                    {{ kvfj($order->getUserAddress->addr_info, 'add2') }},
                                    {{ kvfj($order->getUserAddress->addr_info, 'add3') }}</p>
                                <p><strong>Referencia:
                                    </strong>{{ kvfj($order->getUserAddress->addr_info, 'add4') }}
                                </p>
                            @else
                            @endif
                            <div class="switch">
                                <a href="{{ url('/cart/' . $order->id . '/type/0') }}"
                                    class="sl @if ($order->o_type == '0') active @endif "><i
                                        class="fas fa-motorcycle"></i> Domicilio
                                </a>

                                <a href="#" class="sl @if ($order->o_type == '1') active @endif "><i
                                        class="fas fa-car-side"></i> To Go
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="panel shadow mtop16">
                        <div class="header">
                            <h2 class="title"><i class="far fa-envelope-open"></i> Más</h2>
                        </div>
                        <div class="inside">
                            <div class="profile">
                                <div class="info">
                                    <ul>
                                        <li><strong><i class="far fa-clock"></i> Fecha de Solicitud:
                                            </strong>{{ $order->request_at }}</li>
                                        <li><strong><i class="far fa-credit-card"></i> Pagado el:
                                            </strong>{{ $order->paid_at }}</li>
                                        <li><strong><i class="fas fa-blox"></i> Procesando:
                                            </strong>{{ $order->process_at }}</li>
                                        @if ($order->o_type == 0)
                                            <li><strong><i class="fas fa-motorcycle"></i> Enviada:
                                                </strong>{{ $order->send_at }}</li>
                                        @else
                                            <li><strong><i class="fas fa-motorcycle"></i> Lista:
                                                </strong>{{ $order->send_at }}</li>
                                        @endif

                                        <li><strong><i class="fas fa-shipping-fast"></i> Entregada:
                                            </strong>{{ $order->delivery_at }}</li>

                                        @if ($order->rejected_at)
                                            <li><strong><i class="fas fa-recycle"></i> Rechazada:
                                                </strong>{{ $order->rejected_at }}</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Col Nro 1 --}}

                {{-- Col Nro 2 --}}
                <div class="col-md-6">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-clipboard-list"></i> Órdenes</h2>
                        </div>

                        <div class="inside">
                            <table class="table table-striped align-middle table-hover">
                                <thead>
                                    <tr>
                                        <td width="64"></td>
                                        <th>Producto</th>
                                        <th width="160">Cantidad</th>
                                        <th width="124">SubTotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->getItems as $item)
                                        <tr>
                                            <td><img src="{{ getUrlFileFromUploads($item->getProduct->image) }}"
                                                    alt="" class="img-fluid rounded"></td>
                                            <td>
                                                <a
                                                    href="{{ url('/product/' . $item->getProduct->id . '/' . $item->getProduct->slug) }}">
                                                    {{ $item->label_item }}
                                                </a>

                                                <div class="price_discount">
                                                    Precio
                                                    @if ($item->discount_status == 1)
                                                        <span
                                                            class="price_initial">{{ number_format($item->price_initial, 2, '.', ',') . Config::get('configSite.currency') }}
                                                        </span>
                                                    @endif
                                                    <span
                                                        class="price_unit">{{ number_format($item->price_unit, 2, '.', ',') . Config::get('configSite.currency') }}
                                                        @if ($item->discount_status == 1)
                                                            ({{ $item->discount }})
                                                            % de descuento
                                                        @endif
                                                    </span>
                                                </div>
                                            </td>
                                            <td>{{ $item->quantity }}</td>
                                            <th>{{ number($item->total) }}</th>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2"></td>
                                        <td><strong>Subtotal:</strong></td>
                                        <td>{{ number($order->getSubTotalOrder()) }}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="2"></td>
                                        <td><strong>Precio de Envío:</strong></td>
                                        <td>{{ number($order->delivery) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2"></td>
                                        <td><strong>Total:</strong></td>
                                        <td>{{ number($order->total) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @if (kvfj(Auth::user()->permissions, 'order_change_status'))
                                <div class="order_status mtop16">
                                    @if ($order->status == 6 || $order->status == 100)
                                        {!! Form::open(['url' => '#', 'disabled']) !!}
                                    @else
                                        {!! Form::open(['url' => '/admin/order/' . $order->id . '/view']) !!}
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12 mtop16">
                                            <strong>Estado de la orden</strong>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            @if ($order->o_type == 0)
                                                {!! Form::select('status', Arr::except(getOrderStatus(), ['0', '5']), $order->status, [
                                                    'class' => 'form-select',
                                                ]) !!}
                                            @else
                                                {!! Form::select('status', Arr::except(getOrderStatus(), ['0', '4']), $order->status, [
                                                    'class' => 'form-select',
                                                ]) !!}
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            @if ($order->status == 6 || $order->status == 100)
                                                {!! Form::submit('Actualizar', ['class' => 'btn btn-success w-100', 'disabled']) !!}
                                            @else
                                                {!! Form::submit('Actualizar', ['class' => 'btn btn-success w-100']) !!}
                                            @endif

                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- End Col Nro 2 --}}

                {{-- Col Nro 3 --}}
                <div class="col-md-3">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title">
                                <i class="fas fa-credit-card"></i> Método de Pago
                            </h2>
                        </div>

                        <div class="inside">
                            <div class="payments_methods">
                                <a href="#" class="btn_payment_method w-100 active" id="payment_method_cash"
                                    data-payment-method-id="0">
                                    <i class="fas fa-cash-register"></i>
                                    {{ getPaymentsMethods($order->payment_method) }}
                                </a>
                            </div>
                        </div>
                    </div>

                    @if ($order->payment_method == 1)
                        <div class="panel shadow mtop16">
                            <div class="inside">
                                <div class="header">
                                    <h2 class="title"><i class="fas fa-shopping-cart"></i> Comprobante
                                    </h2>
                                </div>
                                <div class="inside">
                                    <a href="{{ getUrlFileFromUploads($order->voucher) }}" target="_blank">
                                        <img src="{{ getUrlFileFromUploads($order->voucher) }}" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="panel shadow mtop16">
                        <div class="header">
                            <h2 class="title"><i class="far fa-envelope-open"></i> Más</h2>
                        </div>
                        <div class="inside">
                            <div class="profile">
                                <div class="info">
                                    <ul>
                                        <li><strong><i class="far fa-clock"></i> Fecha de Solicitud:
                                            </strong>{{ $order->request_at }}</li>
                                        <li><strong><i class="far fa-credit-card"></i> Pagado el:
                                            </strong>{{ $order->paid_at }}</li>
                                        <li><strong><i class="fas fa-blox"></i> Procesando:
                                            </strong>{{ $order->process_at }}</li>
                                        @if ($order->o_type == 0)
                                            <li><strong><i class="fas fa-motorcycle"></i> Enviada:
                                                </strong>{{ $order->send_at }}</li>
                                        @else
                                            <li><strong><i class="fas fa-motorcycle"></i> Lista:
                                                </strong>{{ $order->send_at }}</li>
                                        @endif

                                        <li><strong><i class="fas fa-shipping-fast"></i> Entregada:
                                            </strong>{{ $order->delivery_at }}</li>

                                        @if ($order->rejected_at)
                                            <li><strong><i class="fas fa-recycle"></i> Rechazada:
                                                </strong>{{ $order->rejected_at }}</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel shadow mtop16">
                        <div class="header">
                            <h2 class="title"><i class="far fa-envelope-open"></i> Más</h2>
                        </div>
                        <div class="inside">
                            <label for="user_comment">Comentario</label>
                            @if ($order->user_comment)
                                <p>{!! $order->user_comment !!}</p>
                            @endif
                        </div>
                    </div>

                </div>
                {{-- End Col Nro 3 --}}
            </div>
        </div>
    </div>

@endsection
