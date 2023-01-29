@extends('admin.master')

@section('title', 'Editar Producto')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{url('/admin/products/all')}}"><i class="fas fa-boxes"> Productos</i></a>
</li>

<li class="breadcrumb-item">
    <a href="{{url('/admin/product/'.$inventory->getProduct->id.'/edit')}}"><i class="fas fa-boxes">
            {{$inventory->getProduct->name}}</i></a>
</li>

<li class="breadcrumb-item">
    <a href="{{url('/admin/product/'.$inventory->product_id.'/inventory')}}"><i class="fas fa-boxes"> Inventario</i></a>
</li>

<li class="breadcrumb-item">
    <a href="{{url('/admin/product/inventory/'.$inventory->id.'/edit')}}"><i class="fas fa-box">
            {{$inventory->name}}</i></a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- columna #1 --}}
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-box"></i>Editar Iventario</h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url'=>'/admin/product/inventory/'.$inventory->id.'/edit']) !!}
                    <label for="name">Nombre:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::text('name', $inventory->name, ['class'=>'form-control']) !!}
                    </div>

                    <label for="inventory" class="mtop16">Disponibilidad:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::number('inventory', $inventory->quantity, ['class'=>'form-control','min'=>1]) !!}
                    </div>

                    <label for="price" class="mtop16">Precio:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            {{Config('configSite.currency')}}
                        </span>
                        {!! Form::number('price', $inventory->price, ['class'=>'form-control','min'=>1, 'step'=>'any'])
                        !!}
                    </div>

                    <label for="limited" class="mtop16">Límite:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::select('limited', ['0'=>'Limitado', '1'=>'Ilimitado'],
                        $inventory->limited,['class'=>'form-select'] )
                        !!}
                    </div>

                    <label for="minimum" class="mtop16">Cantidad Mínima:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::number('minimum', $inventory->minimum, ['class'=>'form-control','min'=>1]) !!}
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
                    <h2 class="title"><i class="fas fa-box"></i>Variantes</h2>
                </div>

                <div class="inside">
                    {!! Form::open(['url'=>'/admin/product/inventory/'.$inventory->id.'/variant']) !!}
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::open(['url'=>'/admin/product/inventory/'.$inventory->id.'/edit']) !!}
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-keyboard"></i>
                                </span>
                                {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Nombre de la variante']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success mtop16']) !!}
                        </div>
                    </div>
                        {!! Form::close() !!}
                    
                    <hr>
                    <table class="table">
                        
                        <thead>
                            <tr>
                                <td>id</td>
                                <td>Nombre</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventory->getVariants as $variant)
                                <tr>
                                    <td>{{$variant->id}}</td>
                                    <td>{{$variant->name}}</td>
                                    <td>
                                        <div class="opts">
                                            <a href="#" data-path="admin/product/variant" data-action="delete" data-object={{
                                                $variant->id
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