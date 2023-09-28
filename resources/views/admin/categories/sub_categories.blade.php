@extends('admin.master')

@section('title', 'Agregar Categoría')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ '/admin/categories/0' }}"><i class="far fa-folder-open"></i>Categorias</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#"><i class="far fa-folder-open"></i>Categoria: {{ $category->name }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="#"><i class="far fa-folder-open"> Sub-categorías</i></a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="far fa-folder-open"></i> Sub-Categorías - {{ $category->name }}</h2>
                    </div>
                    <div class="inside">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td width="32px">Icono</td>
                                    <td>Nombre</td>
                                    <td width="160px"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category->getSubCategories as $subCategory)
                                    <tr>
                                        <td>
                                            @if (!is_null($subCategory->icon))
                                                <img src="{{ getUrlFileFromUploads($subCategory->icon) }}"
                                                    class="img-fluid">
                                            @endif
                                        </td>
                                        <td>{{ $subCategory->name }}</td>
                                        <td>
                                            <div class="opts">
                                                @if (kvfj(Auth::user()->permissions, 'category_edit'))
                                                    <a href="{{ url('/admin/category/' . $subCategory->id . '/edit') }}"
                                                        data-toogle="tooltip" data-toggle="tooltip" data-placement="top"
                                                        title="Eliminar" class="edit"><i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                                @if (is_null($subCategory->deleted_at))
                                                    <a href="#" data-path="admin/category" data-action="delete"
                                                        data-object={{ $subCategory->id }} data-toggle="tooltip"
                                                        data-placement="top" title="Eliminar" class="btn_deleted deleted"><i
                                                            class="fas fa-trash-alt"></i>
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
