@extends('admin.master')

@section('title', 'Productos')

@section('breadcrumb')

<li class="breadcrumb-item">
    <i class="fas fa-boxes"> Productos</i>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title">
                <i class="fas fa-boxes"> Productos</i>
            </h2>
            <ul>
                @if(kvfj(Auth::user()->permissions, 'product_add'))
                <li>
                    <a href="{{url('/admin/product/add')}}"><i class="fas fa-plus-circle"></i>
                        Agregar Producto
                    </a>
                </li>
                @endif
                <li>
                    <a href="#">Filtrar <i class="fas fa-chevron-down"></i></a>
                    <ul class="shadow">
                        <li><a href="{{url('/admin/products/1')}}"><i class="fas fa-globe-americas"></i>Publicos</a>
                        </li>
                        <li><a href="{{url('/admin/products/0')}}"><i class="fas fa-eraser"></i> Borrador</a></li>
                        <li><a href="{{url('/admin/products/trash')}}"><i class="fas fa-trash"></i> Papelera</a></li>
                        <li><a href="{{url('/admin/products/all')}}"><i class="fas fa-list"></i> Todos</a></li>

                    </ul>
                </li>

                <li>
                    <a href="#" id="btn_search">
                        <i class="fas fa-search">Buscar</i>
                    </a>
                </li>

            </ul>
        </div>
        <div class="inside">
            <div class="form_search" id="form_search">
                {!! Form::open(['url' => '/admin/product/search']) !!}
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::text('search', null, ['class' =>'form-control', 'placeholder' => 'Buscar'])!!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::select('filter', ['0'=> 'Nombre del Producto', '1'=>'Código'], 0,
                        ['class'=>'form-control']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('status', ['0'=> 'Borrador', '1'=>'Público'], 0,
                        ['class'=>'form-control']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            {{-- <div class="btns">
                @if(kvfj(Auth::user()->permissions, 'product_add'))
                <a href="{{url('/admin/product/add')}}" class="btn btn-success"><i class="fas fa-plus-circle"></i>
            Agregar Producto
            </a>
            @endif
        </div> --}}
        <table class="table table-striped mtop16">
            <thead>
                <tr>
                    <td>id</td>
                    <td>Imagen</td>
                    <td>Nombre</td>
                    <td>Categoría</td>
                    <td>Precio</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td width="50">{{$product->id}}</td>
                    <td width="64">
                        <a href="{{'/uploads/'.$product->file_path.'/t_'.$product->image}}" data-fancybox="gallery">
                            <img src="{{'/uploads/'.$product->file_path.'/t_'.$product->image}}" width="64">
                        </a>
                    </td>
                    <td>{{$product->name}} @if($product->status == 0) <i class="fas fa-eraser" data-toggle="tooltip"
                            data-placement="top" title="Estado: Borrador"></i> @endif</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>
                        <div class="opts">
                            @if(kvfj(Auth::user()->permissions, 'product_edit'))
                            <a href="{{url('/admin/product/'.$product->id.'/edit')}}" data-toggle="tooltip"
                                data-placement="top" title="Editar"><i class="fas fa-edit"></i>
                            </a>
                            @endif

                            @if(kvfj(Auth::user()->permissions, 'product_delete'))
                            <a href="{{url('/admin/product/'.$product->id.'/delete')}}" data-toggle="tooltip"
                                data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i>
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>


        </table>

    </div>
</div>
</div>
@endsection