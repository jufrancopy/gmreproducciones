@extends('emails.master')
@section('content')

<p>Hola: <span>{{$order->getUser->name}} {{$order->getUser->lastname}}</span></p>
<p>Hemos reibido su orden. A continuación tendrá detalles de su compra:</p>
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
            <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px"><img
                    src="{{url('/uploads/'.$item->getProduct->file_path.'/t_'.$item->getProduct->image)}}" alt=""
                    style="width:50px"></td>
            <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px"><a
                    href="{{url('/product/'.$item->getProduct->id.'/'.$item->getProduct->slug)}}"
                    style="color:#333; text-decoration:none; border-radiud:4px">{{$item->label_item}}</a>
                <div class="price_discount">
                    Precio:
                    @if($item->discount_status == 1)
                    <small>
                        <span class="price_initial">
                            {{number($item->price_initial)}}
                        </span>
                        @endif
                        <span class="price_unit">{{number($item->price_unit)}}
                            @if($item->discount_status == 1)
                            ({{$item->discount}}) % de descuento
                            @endif
                        </span>
                    </small>
                </div>

            </td>
            <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px">{{$item->quantity}}</td>
            <th style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px">{{number($order->total)}}
            </th>
        </tr>
        @endforeach
        <tr>
            <td colspan="2" style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px"></td>
            <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px"><strong>Subtotal:</strong>
            </td>
            <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px">
                {{number($order->getSubTotalOrder())}}</td>
        </tr>

        <tr>
            <td colspan="2" style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px"></td>
            <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px"><strong>Precio de
                    Envío:</strong></td>
            <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px">
                {{number($order->delivery)}}
            </td>
        </tr>

        <tr>
            <td colspan="2" style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px"></td>
            <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px"><strong>Total:</strong>
            </td>
            <td style="vertical-align:top; border-bottom:1px solid #f0f0f0; padding:4px 0px">{{number($order->total)}}
            </td>
        </tr>
    </tbody>
</table>
@stop