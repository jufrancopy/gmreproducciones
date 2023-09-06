@extends('admin.master')
@section('title', 'Editar Usuario')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ '/admin/users/all' }}"><i class="fas fa-users"> Usuarios</i></a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page_user">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title">
                                <i class="fas fa-user">Información</i>
                            </h2>
                        </div>

                        <div class="inside">
                            <div class="mini_profile">
                                @if (is_null($user->avatar))
                                    <img src="{{ url('static/images/avatar_default.png') }}" class="avatar">
                                @else
                                    <img src="{{ url('uploads_users/' . $user->id . '/' . $user->avatar) }}" class="avatar">
                                @endif
                                <div class="info">
                                    <span class="title"><i class="far fa-address-card"></i> Nombre:</span>
                                    <span class="text">{{ $user->name }} {{ $user->lastname }}</span>

                                    <span class="title"><i class="far fa-envelope"></i> Correo Electrónico:</span>
                                    <span class="text">{{ $user->email }}</span>

                                    <span class="title"><i class="far fa-calendar-alt"></i> Fecha de creación:</span>
                                    <span class="text">{{ $user->created_at }}</span>

                                    <span class="title"><i class="fas fa-user-tag"></i>Rol de Usuario:</span>
                                    <span class="text">{{ getRoleUserArray(null, $user->role) }}</span>

                                    <span class="title"><i class="fas fa-guitar"></i>Estado:</span>
                                    <span class="text">{{ getUsersStatusArray(null, $user->status) }}</span>
                                </div>
                                @if (kvfj(Auth::user()->permissions, 'user_banned'))
                                    @if ($user->status == 100)
                                        <a href="{{ url('/admin/user/' . $user->id . '/banned') }}"
                                            class="btn btn-info">Reactivar
                                            Usuario</a>
                                    @else
                                        <a href="{{ url('/admin/user/' . $user->id . '/banned') }}"
                                            class="btn btn-danger">Suspender
                                            Usuario</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title">
                                <i class="fas fa-clipboard-list"> Historial de compras</i>
                            </h2>
                        </div>
                        <div class="inside">
                            <table class="table mtop16">
                                <thead>
                                    <th>#</th>
                                    <th>Estado</th>
                                    <th>Tipo</th>
                                    <th>Fecha de Solicitud</th>
                                    <th>Total</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($user->getOrders as $order)
                                        <tr>
                                            <td>{{ $order->o_number }}</td>
                                            <td>{{ getOrderStatus($order->status) }}</td>
                                            <td>{{ getORderType($order->o_type) }}</td>
                                            <td>{{ $order->request_at }}</td>
                                            <td>{{ number($order->total) }}</td>
                                            <td>
                                                @if (kvfj(Auth::user()->permissions, 'order_view'))
                                                    <a href="{{ url('/admin/order/' . $order->id . '/view') }}"
                                                        class="btn btn-primary btn-sm"><i class="fa fa-eye"
                                                            aria-hidden="true"></i>
                                                    </a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>

                    <div class="panel shadow mtop16">
                        <div class="header">
                            <h2 class="title">
                                <i class="fas fa-user-edit"> Editar Información</i>
                            </h2>
                        </div>
                        <div class="inside">

                            @if (kvfj(Auth::user()->permissions, 'user_edit'))
                                {!! Form::open(['url' => '/admin/user/' . $user->id . '/post']) !!}

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="module">Tipo de Usuario:</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="far fa-keyboard"></i>
                                            </span>
                                            {!! Form::select('user_role', getRoleUserArray('list', null), $user->role, ['class' => 'form-select']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row mtop16">
                                    <div class="col-md-12">
                                        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                                    </div>
                                </div>

                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
