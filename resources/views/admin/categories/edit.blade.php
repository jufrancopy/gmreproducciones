@extends('admin.master')

@section('title', 'Agregar Categoría')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{'/admin/categories/0'}}"><i class="far fa-folder-open"></i> Categorias</a>
</li>

@if($category->parent != 0)
<li class="breadcrumb-item">
    <a href="{{'/admin/category/'.$category->parent.'/subs'}}"><i class="far fa-folder-open"></i> {{$category->getParent->name}}</a>
</li>

<li class="breadcrumb-item">
    <a href="{{'/admin/category/'.$category->id.'/edit'}}"><i class="far fa-folder-open"></i> Editando {{$category->name}} </a>
</li>
@endif

@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-edit"></i> Editar Categoría</h2>
                </div>
                <div class="inside">
                    {!!Form::open(['url'=>'/admin/category/'.$category->id.'/edit', 'files'=>true])!!}
                    <label for="name">Nombre:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>

                        {!! Form::text('name', $category->name, ['class'=>'form-control']) !!}
                    </div>
                    
                    <label for="icono" class="mtop16">Ícono:</label>
                    <div class="form-file">
                        {!! Form::file('icon', ['class'=>'form-control',
                        'id'=>'customFile',
                        'accept'=>'image/*',
                        'lang'=>'es']) !!}
                    </div>

                    <label for="order" class="mtop16">Orden:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>

                        {!! Form::number('order', $category->order, ['class'=>'form-control']) !!}
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-12">
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
                    <h2 class="title"><i class="fas fa-edit"></i> Ícono</h2>
                </div>
                <div class="inside">
                    
                </div>
            </div>
        </div>
        @if(!is_null($category->icono))
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-edit"></i> Icono Actual</h2>
                </div>
                <div class="inside">
                    <img src="{{ url('/uploads/'.$category->file_path.'/'.$category->icono)  }}" class="img-fluid">
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection