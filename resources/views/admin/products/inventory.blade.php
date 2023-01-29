@extends('admin.master')

@section('title', 'Editar Producto')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{url('/admin/products/all')}}"><i class="fas fa-boxes"> Productos</i></a>
</li>
<li class="breadcrumb-item">
    <a href="{{url('/admin/product/'.$product->id.'/edit')}}"><i class="fas fa-boxes">{{$product->name}}</i></a>
</li>
<li class="breadcrumb-item">
    <a href="{{url('/admin/product/'.$product->id.'/inventory')}}"><i class="fas fa-box"> Inventario</i></a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- columna #1 --}}
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-box"></i>Inventario de Producto</h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url'=>'/admin/product/'.$product->id.'/inventory']) !!}
                    <label for="name">Nombre:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>

                    <label for="inventory" class="mtop16">Disponibilidad:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::number('inventory', 1, ['class'=>'form-control','min'=>1]) !!}
                    </div>

                    <label for="price" class="mtop16">Precio:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            {{Config('configSite.currency')}}
                        </span>
                        {!! Form::number('price', 1.00, ['class'=>'form-control','min'=>1, 'step'=>'any']) !!}
                    </div>

                    <label for="limited" class="mtop16">Límite:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::select('limited', ['0'=>'Limitado', '1'=>'Ilimitado'], 0,['class'=>'form-select'] )
                        !!}
                    </div>

                    <label for="minimum" class="mtop16">Cantidad Mínima:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::number('minimum', 1.00, ['class'=>'form-control','min'=>1]) !!}
                    </div>
                    {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>

        {{-- columna #2 --}}
        <div class="col-md-9">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-box"></i>Inventarios</h2>
                </div>
                <div class="inside">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>id</td>
                                <td>Nombre</td>
                                <td>Disponibilidad</td>
                                <td>Limite</td>
                                <td>Precio</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product->getInventory as $inventory)
                            <tr>
                                <td>{{$inventory->id}}</td>
                                <td>{{$inventory->name}}</td>

                                @if($inventory->limited == 1)
                                <td>Ilimitada</td>
                                @else
                                <td>{{$inventory->quantity}}</td>
                                @endif

                                @if($inventory->limited == 1)
                                <td>Ilimitada</td>
                                @else
                                <td>{{$inventory->minimun}}</td>
                                @endif

                                <td>{{Config('configSite.currency')}}{{$inventory->price}}</td>
                                <td width=160>
                                    <div class="opts">
                                        <a href="{{url('/admin/product/inventory/'.$inventory->id.'/edit')}}"
                                            data-toggle="tooltip" data-placement="top" title="Editar" class="edit"><i
                                                class="fas fa-edit"></i>
                                        </a>

                                        <a href="#" data-path="admin/product/variant" data-action="delete" data-object={{
                                            $inventory->id
                                            }} data-toggle="tooltip" data-placement="top"
                                            title="Eliminar" class="btn_deleted deleted" class=""><i
                                                class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
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