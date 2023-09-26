@extends('admin.master')

@section('title', 'Editar Producto')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{url('/admin/products/all')}}"><i class="fas fa-boxes"> Productos</i></a>
</li>
<li class="breadcrumb-item">
    <i class="fas fa-edit"> Editar Producto</i>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-edit"></i>Editar Producto</h2>
                    {{-- {{config('configSite.upload_server_path')}} --}}
                </div>
                <div class="inside">
                    {!!Form::open(['url'=>'admin/product/'.$product->id.'/edit', 'files'=>true])!!}
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name">Nombre del Producto:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('name', $product->name, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-6">
                            <label for="category_id">Categoría Padre:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                                {!!Form::select('category_id', $cats,$product->category_id,['class' =>
                                'form-select', 'id'=>'category'])!!}
                                {!! Form::hidden('subCategoryNow', $product->subCategory_id, ['id'=>'subCategoryNow'])
                                !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="subCategory">Sub-Categoría</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                                {!!Form::select('subCategory_id', [], null,['class' =>
                                'form-select', 'id'=>'subCategory', 'required'])!!}
                            </div>
                        </div>
                    </div>
                    <div class="row mtop16">
                        <div class="col-md-3">
                            <label for="in_discount">En descuento:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                                {!!Form::select('in_discount',['0'=>'No','1'=>'Si'],$product->in_discount,['class' =>
                                'form-select'])!!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="discount">Descuento:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                                {!!Form::number('discount', $product->discount,['class' => 'form-select'])!!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="discount_until_date">Fecha limite de descuento:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                                {!!Form::date('discount_until_date', $product->discount_until_date,['class' => 'form-control'])!!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="image">Imagen destacada:</label>
                            <div class="custom-file">
                                {!! Form::file('image', ['class'=>'form-control', 'id'=>'customFile',
                                'accept'=>'image/*',
                                'lang'=>'es']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mtop16">
                        <div class="col-md-3">
                            <label for="code">Código de Sistema:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                                {!!Form::text('code', $product->code,['class' => 'form-control'])!!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="status">Estado:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                                {!!Form::select('status',['0'=>'Borrador','1'=>'Publicado'],$product->status,['class' =>
                                'form-select'])!!}
                            </div>
                        </div>
                    </div>
                    <div class="row mtop16">
                        <div class="col-md-12">
                            <label for="content">Descripción</label>
                            {!! Form::textarea('content', $product->content, ['class'=>'form-control',
                            'id'=>'editor']) !!}
                        </div>
                    </div>
                    <div class="row mtop16">
                        <div class="col md-12">
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="far fa-image"></i> Imagen Destacada</h2>
                    <div class="inside">
                        <img src="{{ getUrlFileFromUploads($product->image) }}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="panel shadow mtop16">
                <div class="header">
                    <h2 class="title"><i class="far fa-images"></i> Galería</h2>
                </div>
                <div class="inside product_gallery">
                    {!! Form::open(['url'=>'/admin/product/'.$product->id.'/gallery/add', 'files'=>true,
                    'id'=>'form_product_gallery']) !!}
                    {!! Form::file('file_image', ['id'=>'product_file_image', 'accept'=>'image/*', 'required']) !!}
                    {!! Form::close() !!}
                    <div class="btn-submit">
                        @if(kvfj(Auth::user()->permissions, 'product_gallery_add'))
                        <a href="#" id="btn_product_file_image"><i class="fas fa-plus-circle"></i></a>
                        @endif
                    </div>
                    <div class="tumbs">
                        @foreach ($product->getGallery as $img)
                        <div class="tumb">
                            @if(kvfj(Auth::user()->permissions, 'product_gallery_delete'))
                            <a href="{{url('/admin/product/'.$product->id.'/gallery/'.$img->id.'/delete')}}"
                                data-toogle="tooltip" data-toggle="tooltip" data-placement="top" title="Eliminar"><i
                                    class="fas fa-trash-alt"></i>
                            </a>
                            @endif
                            <img src="{{ getUrlFileFromUploads($img->file_name) }}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection