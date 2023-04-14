@extends('master')

@section('title', 'Carrito de Compra')

@section('content')
<div class="cart mtop-32">
    <div class="container">
        @if(count(collect($items)) == 0)
        <div class="no_items shadow">
            <div class="inside">
                <p><img src="{{url('/static/images/empty-cart.png')}}" alt=""></p>
                <p><strong>Hola {{Auth::user()->name}}</strong>, aún no tienes seleccionado ningún producto.</p>
                <p>
                    <a href="{{url('/store')}}">Ir a la tienda</a>
                </p>
            </div>
        </div>
        @else
        <div class="items mtop32">
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="inside">
                            <table class="table table-striped align-middle table-hover">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td width="64"></td>
                                        <th>Producto</th>
                                        <th width="160">Cantidad</th>
                                        <th width="124">SubTotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                    <tr>
                                        <td>
                                            <a href="{{url('/cart/item/'.$item->id.'/delete')}}" class="btn-delete">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                        <td><img src="{{url('/uploads/'.$item->getProduct->file_path.'/t_'.$item->getProduct->image)}}"
                                                alt="" class="img-fluid rounded"></td>
                                        <td><a
                                                href="{{url('/product/'.$item->getProduct->id.'/'.$item->getProduct->slug)}}">{{$item->label_item}}</a>
                                            @if($item->discount_status == 1)
                                            Precio:
                                            <div class="price_discount">
                                                <span class="price_initial">{{number_format($item->price_initial, 2,
                                                    '.',',').Config::get('configSite.currency')}}</span>
                                                @endif
                                                <span class="price_unit">{{number_format($item->price_unit, 2,
                                                    '.',',').Config::get('configSite.currency')}}
                                                    @if($item->discount_status == 1)
                                                    ({{$item->discount}})% de descuento
                                                    @endif
                                                </span>
                                            </div>

                                        </td>
                                        <td width=120>
                                            <div class="form_quantity">
                                                {!! Form::open(['url'=>'/cart/item/'.$item->id.'/update']) !!}
                                                {!! Form::number('quantity',$item->quantity, ['min'=>1,
                                                'class'=>'form-control']) !!}
                                                <button type="submit"><i class="far fa-save"></i></button>
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                        <th>{{number_format($item->total, 2, '.',',').'
                                            '.Config::get('configSite.currency')}}</th>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3"></td>
                                        <td><strong>Subtotal:</strong></td>
                                        <td>{{number_format($order->getSubTotalOrder(), 2,
                                            '.',',').''.Config::get('configSite.currency')}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="3"></td>
                                        <td><strong>Precio de Envío:</strong></td>
                                        <td>{{number_format(0.00, 2, '.',',').''.Config::get('configSite.currency')}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3"></td>
                                        <td><strong>Total:</strong></td>
                                        <td>{{number_format(0.00, 2, '.',',').''.Config::get('configSite.currency')}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                
                <div class="col-md-3">
                    {!! Form::open(['url'=>'/cart']) !!}
                    <div class="panel">
                        <div class="header">
                            <h2 class="title">
                                <i class="fas fa-map-marker"></i>Dirección de Envío
                            </h2>
                        </div>
                        <div class="inside">

                        </div>
                    </div>

                    <div class="panel">
                        <div class="header">
                            <h2 class="title">
                                <i class="fas fa-envelope-open"></i>Más...
                            </h2>
                        </div>
                        <div class="inside">
                            <label for="order_msg">Enviar Comentario</label>
                            {!! Form::textarea('order_msg', null, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="panel">
                        <div class="inside">
                            {{ Form::submit('Completar la Orden', ['class'=>'btn btn-success']) }}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                
            </div>
        </div>
        @endif
    </div>
</div>
@stop