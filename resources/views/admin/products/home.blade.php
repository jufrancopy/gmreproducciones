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
                {!! Form::open(['url' => 'admin/product/search']) !!}
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::text('search', null, ['class' =>'form-control', 'placeholder' => 'Buscar',
                        'required'])!!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::select('filter', ['0'=> 'Nombre del Producto', '1'=>'Código'], 0,
                        ['class'=>'form-select']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('status', ['0'=> 'Borrador', '1'=>'Público'], 0,
                        ['class'=>'form-select']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::submit('buscar', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <table class="table table-striped mtop16">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio mínimo</th>
                        <th></th>
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

                        <td>
                            <p style="margin-bottom: 0px">
                                {{$product->name}}
                                @if($product->status == 0) <i class="fas fa-eraser" data-toggle="tooltip"
                                    data-placement="top" title="Estado: Borrador"></i>
                                @endif
                            </p>
                            <p>
                                <small><i class="far fa-folder-open"></i>
                                    {{$product->category->name}} <i class="fas fa-angle-double-right"></i>
                                    @if($product->subCategory_id != 0)
                                    {{$product->subCategory->name}}
                                    @endif
                                </small>
                            </p>
                        </td>
                        <td>
                            {{Config('configSite.currency')}} {{$product->getPrice->min('price')}}
                        </td>


                        <td width=160>
                            <div class="opts">
                                @if(kvfj(Auth::user()->permissions, 'product_edit'))
                                <a href="{{url('/admin/product/'.$product->id.'/edit')}}" data-toggle="tooltip"
                                    data-placement="top" title="Editar" class="edit"><i class="fas fa-edit"></i>
                                </a>
                                @endif
                                @if(kvfj(Auth::user()->permissions, 'product_inventory'))
                                <a href="{{ url('/admin/product/'.$product->id.'/inventory') }}" data-toggle="tooltip"
                                    data-placement="top" title="Inventario" class="inventory"><i
                                        class="fas fa-box"></i></a>
                                @endif
                                @if(kvfj(Auth::user()->permissions, 'product_delete'))
                                @if(is_null($product->deleted_at))
                                <a href="#" data-path="admin/product" data-action="delete" data-object={{ $product->id
                                    }} data-toggle="tooltip" data-placement="top"
                                    title="Eliminar" class="btn_deleted deleted" class=""><i
                                        class="fas fa-trash-alt"></i>
                                </a>
                                @else
                                <a href="{{ url('/admin/product/'.$product->id.'/restore') }}" data-action="restore"
                                    data-path="admin/product" data-object={{ $product->id }} data-toggle="tooltip"
                                    data-placement="top" title="Restaurar" class="btn_deleted restore"><i
                                        class="fas fa-trash-restore"></i>
                                </a>
                                @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tr>
                    <td colspan="6">{{ $products->render() }}</td>
                </tr>

            </table>
        </div>
    </div>
</div>
@endsection