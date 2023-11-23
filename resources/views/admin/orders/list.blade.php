@extends('admin.master')
@section('title', 'Órdenes')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/orders/' . $status) }}"><i class="fas fa-clipboard-list"> Órdenes</i></a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-filter"></i> Filtrar por estado </h2>
                    </div>

                    <div class="list-group">
                        <a href="{{ url('/admin/orders/all/' . $type) }}"
                            class="list-group-item list-group-item-action
                            @if ($status == 'all') active @endif "
                            aria-current="true">
                            <i class="fas fa-chevron-right"></i> Todas
                            <span class="badge bg-primary rounded-pill">{{ $allOrders->count() }}
                            </span>
                        </a>
                        @foreach (Arr::except(getOrderStatus(), ['0']) as $key => $value)
                            <a href="{{ url('/admin/orders/' . $key . '/' . $type) }}"
                                class="list-group-item list-group-item-action
                                @if ($status == $key) active @endif "
                                aria-current="true">
                                <i class="fas fa-chevron-right"></i> {{ $value }}
                                <span class="badge bg-primary rounded-pill">{{ $allOrders->where('status', $key)->count() }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-clipboard-list"></i> Órdenes</h2>
                    </div>

                    <div class="inside">
                        <ul class="nav nav-pills nav-fill">
                            <li class="nav-item">
                                <a class="nav-link @if ($type == 'all') active @endif" aria-current="page"
                                    href="{{ url('/admin/orders/' . $status . '/all') }}">Todas</a>
                            </li>
                            @foreach (getORderType() as $key => $value)
                                <li class="nav-item">
                                    <a class="nav-link @if ($type == $key) active @endif" aria-current="page"
                                        href="{{ url('/admin/orders/' . $status . '/' . $key) }}">{{ $value }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <table class="table mtop16">
                            <thead>
                                <th>#</th>
                                <th>Usuarios</th>
                                <th>Tipo</th>
                                <th>Método de Pago</th>
                                <th>Fecha de Solicitud</th>
                                <th>Total</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->o_number }}</td>


                                        <td>
                                            <a href="{{ url('admin/user/' . $order->user_id . '/view') }}">
                                                {{ $order->getUser->fullname }} </a>
                                        </td>
                                        <td>{{ getORderType($order->o_type) }}</td>
                                        <td>{{ getPaymentsMethods($order->payment_method) }}</td>
                                        <td>{{ $order->request_at }}</td>
                                        <td>{{ number($order->total) }}</td>
                                        <td>
                                            <a href="{{ url('/admin/order/' . $order->id . '/view') }}"
                                                class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6">{!! $orders->render() !!}</td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
