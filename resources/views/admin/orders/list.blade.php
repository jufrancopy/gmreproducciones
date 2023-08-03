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
                        <h2 class="title"><i class="fas fa-filter"></i> Filtrar</h2>
                    </div>

                    <div class="list-group">
                        <a href="{{ url('/admin/orders/all') }}" class="list-group-item list-group-item-action"
                            @if ($status == 'all') active @endif>
                            <i class="fas fa-chevron-right"></i> Todas
                        </a>
                        @foreach (Arr::except(getOrderStatus(), ['0']) as $key => $value)
                            <a href="{{ url('/admin/orders/' . $key) }}" class="list-group-item list-group-item-action"
                                @if ($status == $key) active @endif aria-current="true">
                                <i class="fas fa-chevron-right"></i> {{ $value }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
