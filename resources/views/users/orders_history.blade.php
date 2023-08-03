@extends('master')
@section('title', 'Editar Perfil')
@section('content')
<div class="row mtop32">
    <div class="col-md-12">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-history"></i> Editar Avatar</h2>
            </div>
            <div class="inside">
                <div class="edit_avatar">
                    <table class="table table-striped align-middle table-hover">
                        <thead>
                            <tr>
                                <td>#</td>
                                <th>Estado</th>
                                <th>Cantidad</th>
                                <th>Tipo</th>
                                <th>Método de Pago</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(Auth::user()->getOrders as $order) 
                                <tr>
                                    <td>{{ $order->o_number }}</td>
                                    <td>{{ getOrderStatus($order->status) }}</td>
                                    <td>{{ getOrderType($order->o_type) }}</td>
                                    <td>{{ getPaymentsMethods($order->payment_method) }}</td>
                                    <td>{{ number($order->total) }}</td>
                                    <td>
                                        <a href="{{  url('/account/history/order/'.$order->id) }}" class="btn btn-info btn-sm text-white w-100"><i class="far fa-clipboard"></i> Ver detalle</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection