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
                                        </td>
                                        <td width=120>
                                            <div class="form_quantity">
                                                {!! Form::open(['url'=>'/cart/item/'.$item->id.'/update']) !!}
                                                {!! Form::number('quantity',$item->quantity, ['min'=>1, 'class'=>'form-control']) !!}
                                                <button type="submit"><i class="far fa-save"></i></button>
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                        <th>{{number_format($item->total, 2, '.',',').' '.Config::get('configSite.currency')}}</th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@stop