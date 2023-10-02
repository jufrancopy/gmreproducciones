@extends('master')

@section('title', 'Orden #' . $order->o_number)

@section('content')
    <div class="cart mtop32">
        <div class="container">
            <div class="items mtop32">
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="header">
                                <h2 class="title"><i class="fas fa-shipping-cart"></i> Detalle de su # {{ $order->o_number }}
                                </h2>
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
                                                <td>{{ $order->quantity }}</td>
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
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 detail_shipping">
                        <div class="panel">
                            <div class="header">
                                <h2 class="title">
                                    <i class="fas fa-map-marker"></i> Tipo de Orden
                                </h2>
                            </div>
                            <div class="inside">
                                <div class="detail_shipping_info">
                                    @if ($order->o_type == 0)
                                        <p><strong>Estado: </strong> {{ $order->getUserAddress->getState->name }}
                                        </p>
                                        <p><strong>Ciudad: </strong> {{ $order->getUserAddress->getCity->name }}
                                        </p>
                                        <p><strong>Barrio:
                                            </strong>{{ kvfj($order->getUserAddress->addr_info, 'add1') }}
                                        </p>
                                        <p><strong>Dirección: </strong>,
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

                            <div class="panel mtop16">
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

                            <div class="panel mtop16">
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
                    </div>
                </div>
            </div>
        </div>
    @endsection
