@extends('master')

@section('title', 'Carrito de Compra')

@section('content')
<div class="cart mtop-32">
    <div class="container">
        @if(count(collect($items)) == 0)
        <div class="no_items">
            <div class="inside shadow">
                <p><img src="{{url('/static/images/empty-cart.png')}}" alt=""></p>
                <p><strong>Hola {{Auth::user()->name}}</strong>, aún no tienes seleccionado ningún producto.</p>
                <p>
                    <a href="{{url('/store')}}">Ir a la tienda</a>
                </p>
            </div>
        </div>
        @else
        @endif
    </div>
</div>
@stop