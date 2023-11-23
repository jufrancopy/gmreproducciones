@extends('admin.master')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid">
    @if(kvfj(Auth::user()->permissions, 'dashboard_small_stats'))
    <div class="panel shadow">
        <div class="header">
            <h2 class="title">
                <i class="fas fa-chart-bar" aria-hidden="true"></i> Estadísticas rápidas.
            </h2>
        </div>
    </div>
    <div class="row mtop16">
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title">
                        <i class="fa fa-users" aria-hidden="true"></i> Usuarios Registados
                    </h2>
                </div>
                <div class="inside">
                    <div class="big_count">{{ $users }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title">
                        <i class="fas fa-boxes" aria-hidden="true"></i> Productos
                    </h2>
                </div>
                <div class="inside">
                    <div class="big_count">{{ $products }}</div>
                </div>
            </div>
        </div>

        @if(kvfj(Auth::user()->permissions, 'dashboard_sell_today'))
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title">
                        <i class="fas fa-chart-bar" aria-hidden="true"></i> Órdenes Hoy
                    </h2>
                </div>
                <div class="inside">
                    <div class="big_count">{{$orders->count()}}</div>
                </div>
            </div>
        </div>
        @endif

        @if(kvfj(Auth::user()->permissions, 'dashboard_sell_today'))
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title">
                        <i class="fas fa-chart-bar" aria-hidden="true"></i> Facturados Hoy
                    </h2>
                </div>
                <div class="inside">
                    <div class="big_count">{{number($orders->sum('total'))}}</div>
                </div>

            </div>
        </div>
        @endif
    </div>
    <div class="row mtop16">
        @if($orders->count() > 0) 
        <div class="col-md-6">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title">
                        <i class="fas fa-clipboard-list" aria-hidden="true"></i> Últimas órdenes hoy
                    </h2>
                </div>
                <div class="inside">
                    
                </div>
            </div>
        </div>
        @endif
    </div>
    @endif
</div>
@endsection