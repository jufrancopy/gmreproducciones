@extends('master')

@section('title', 'Tienda - ' . $category->name)

@section('custom_meta')
    <meta name="category_id" content="{{ $category->id }}">
@stop

@section('content')
    <div class="store">
        <div class="row mtop32">
            <div class="col-md-3">
                <div class="categories_list shadow-lg">
                    <h2 class="title"><i class="fas fa-stream"></i>{{ $category->name }}</h2>
                    <ul>
                        @if ($category->parent != 0)
                            <li>
                                <a
                                    href="{{ url('/store/category/' . $category->getParent->id . '/' . $category->getParent->slug) }}">
                                    <small><i class="fas fa-chevron-left"></i> Regresar a
                                        {{ $category->getParent->name }}</small>
                                </a>
                            </li>
                        @endif
                        @if ($category->parent == 0)
                            <li>
                                <a href="{{ url('/store/') }}">
                                    <small><i class="fas fa-chevron-left"></i> Regresar a la Tienda</small>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/store/category/' . $category->id . '/' . $category->slug) }}">
                                    <small><i class="fas fa-chevron-down"></i>Sub-Categorías</small>
                                </a>
                            </li>
                        @endif
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ url('/store/category/' . $category->id . '/' . $category->slug) }}">
                                    <img src="{{ getUrlFileFromUploads($category->icon) }}" alt="{{ $category->name }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="store_white">
                    <h2 class="home_title">
                        <i class="fas fa-store-alt"></i>
                        {{ $category->name }}
                    </h2>
                    <div class="products_list" id="products_list"></div>
                    <div class="load_more_products">
                        <a href="#" id="load_more_products"><i class="far fa-paper-plane"></i>Ver más...</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
