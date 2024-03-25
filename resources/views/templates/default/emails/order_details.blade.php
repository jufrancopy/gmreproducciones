@extends('emails.master')
@section('content')

    <p>Hola: <span>{{ $order->getUser->name }} {{ $order->getUser->lastname }}</span></p>
    <p>Hemos reibido su orden #{{ $order->o_number }}. A continuación tendrá detalles de su compra:</p>
    <table class="table table-striped align-middle table-hover">
        <thead>
            <tr>
                <td width="56"></td>
                <th>Producto</th>
                <th width="160">Cantidad</th>
                <th width="124">SubTotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->getItems as $item)
                <tr style='border-bottom: 1px solid #f0f0f0;'>
                    <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px">
                        <img src="{{ getUrlFileFromUploads($item->getProduct->image) }}"
                            style="width:50px; border-radius:4px;">
                    </td>
                    <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px"><a
                            href="{{ url('/product/' . $item->getProduct->id . '/' . $item->getProduct->slug) }}"
                            style="color:#333; text-decoration:none; border-radiud:4px">{{ $item->label_item }}</a>
                        <div class="price_discount" style="font-weight: 700">
                            Precio:
                            @if ($item->discount_status == 1)
                                <small>
                                    <span class="price_initial">
                                        {{ number($item->price_initial) }}
                                    </span>
                            @endif
                            <span class="price_unit">{{ number($item->price_unit) }}
                                @if ($item->discount_status == 1)
                                    ({{ $item->discount }})
                                    % de descuento
                                @endif
                            </span>
                            </small>
                        </div>

                    </td>
                    <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px">{{ $item->quantity }}
                    </td>
                    <th style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px">
                        {{ number($item->total) }}
                    </th>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px"></td>
                <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px"><strong>Subtotal:</strong>
                </td>
                <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px">
                    {{ number($order->getSubTotalOrder()) }}</td>
            </tr>

            <tr>
                <td colspan="2" style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px"></td>
                <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px"><strong>Precio de
                        Envío:</strong></td>
                <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px">
                    {{ number($order->delivery) }}
                </td>
            </tr>

            <tr>
                <td colspan="2" style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px"></td>
                <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px"><strong>Total:</strong>
                </td>
                <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px">
                    {{ number($order->total) }}
                </td>
            </tr>
        </tbody>
    </table>


    @if ($order->o_type == 0)
        <p style="margin-top:0px"><strong>La orden será enviada a la dirección:</strong> </p>
        <p style="margin-top:0px"><strong>Estado: </strong> {{ $order->getUserAddress->getState->name }} </p>
        <p style="margin-top:0px"><strong>Ciudad: </strong> {{ $order->getUserAddress->getCity->name }} </p>
        <p style="margin-top:0px"><strong>Barrio: </strong>{{ kvfj($order->getUserAddress->addr_info, 'add1') }}
        </p>
        <p style="margin-top:0px"><strong>Dirección: </strong>, {{ kvfj($order->getUserAddress->addr_info, 'add2') }},
            {{ kvfj($order->getUserAddress->addr_info, 'add3') }}</p>
        <p style="margin-top:0px"><strong>Referencia:
            </strong>{{ kvfj($order->getUserAddress->addr_info, 'add4') }}
        </p>
    @endif
    <hr>
    <p>
        La empresa se reserva el derecho de cancelar o rechazar una orden, sin previo aviso. Si usted transfierió o pagó por
        Tarjeta de Crédito, la misma será reembolsada en las próximas 48 horas hábiles
    </p>
    @if ($order->payment_method == 0)
        <p>Ha seleccionado pagar en ventanilla</p>
    @endif
@stop
