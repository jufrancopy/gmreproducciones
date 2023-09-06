@extends('admin.master')

@section('title', 'Agregar Categoría')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ '/admin/categories/0' }}"><i class="far fa-folder-open"> Categorias</i></a>
    </li>

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus-circle"></i>Agregar Categoría</h2>
                    </div>
                    <div class="inside">
                        @if (kvfj(Auth::user()->permissions, 'category_add'))
                            {!! Form::open(['url' => 'admin/category/add/' . $module, 'files' => true]) !!}
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-keyboard"></i>
                                </span>
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                            <label for="module" class="mtop16">Categoría padre:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-keyboard"></i>
                                </span>
                                <select name="parent" id="" class="form-select  ">
                                    <option value="0">Sin Categoría padre</option>
                                    @foreach ($cats as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="module" class="mtop16">Módulo:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-keyboard"></i>
                                </span>
                                {!! Form::select('module', getModulesArray(), $module, ['class' => 'form-select', 'disabled']) !!}
                            </div>
                            <label for="module" class="mtop16">Ícono:</label>
                            <div class="form-file">
                                {!! Form::file('icono', [
                                    'class' => 'form-control',
                                    'id' => 'customFile',
                                    'accept' => 'image/*',
                                    'lang' => 'es',
                                ]) !!}
                            </div>

                            <div class="row mtop16">
                                <div class="col md-12">
                                    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="far fa-folder-open"></i> Categoría</h2>
                    </div>
                    <div class="inside">
                        <nav class="nav">
                            @foreach (getModulesArray() as $key => $m)
                                <a class="nav-link nav-pills nav-fill" href="{{ url('/admin/categories/' . $key) }}"><i
                                        class="fas fa-th-list"></i> {{ $m }}</a>
                            @endforeach
                        </nav>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td width="32px">Icono</td>
                                    <td>Nombre</td>
                                    <td width="160px"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cats as $category)
                                    <tr>
                                        <td>
                                            @if (!is_null($category->icono))
                                                <img src="{{ url('/uploads/' . $category->file_path . '/' . $category->icono) }}"
                                                    class="img-fluid">
                                            @endif
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <div class="opts">
                                                @if (kvfj(Auth::user()->permissions, 'category_edit'))
                                                    <a href="{{ url('/admin/category/' . $category->id . '/edit') }}"
                                                        data-toogle="tooltip" data-toggle="tooltip" data-placement="top"
                                                        title="Editar" class="edit"><i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ url('/admin/category/' . $category->id . '/subs') }}"
                                                        data-toogle="tooltip" data-toggle="tooltip" data-placement="top"
                                                        title="Sub-categorías" class="inventory"><i
                                                            class="fas fa-list-ul"></i>
                                                    </a>
                                                @endif
                                                @if (is_null($category->deleted_at))
                                                    <a href="#" data-path="admin/category" data-action="delete"
                                                        data-object={{ $category->id }} data-toggle="tooltip"
                                                        data-placement="top" title="Eliminar" class="btn_deleted deleted"
                                                        data-action="delete" data-path="admin/category"
                                                        data-object="{{ $category->id }}"><i class="fas fa-trash-alt"></i>
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
        </div>
    </div>
@endsection
