@extends('master')
@section('title', $product->name)

@section('content')

<div class="product_single shadow-lg">
    <div class="container">
        <div class="row">
            {{-- Feature Img and Gallery --}}
            <div class="col-md-4 pleft0">
                <div class="slick-slider">
                    <div>
                        <a href="{{url('/uploads/'.$product->file_path.'/'.$product->image)}}" data-fancybox="gallery">
                            <img src="{{url('/uploads/'.$product->file_path.'/'.$product->image)}}" class="img-fluid">
                        </a>

                    </div>

                    @if(count($product->getGallery) > 0 )
                    @foreach ($product->getGallery as $gallery )
                    <div>
                        <a href="{{url('/uploads/'.$gallery->file_path.'/t_'.$gallery->file_name)}}"
                            data-fancybox="gallery">
                            <img src="{{url('/uploads/'.$gallery->file_path.'/t_'.$gallery->file_name)}}"
                                class="img-fluid">
                        </a>
                    </div>
                    @endforeach
                    @endif

                </div>
            </div>
            <div class="col-md-8">
                <h2 class="title">{{$product->name}}</h2>
                <div class="category">
                    <ul>
                        <li><a href="{{url('/')}}"><i class="fas fa-house-user"></i> Inicio</a></li>
                        <li><span class="next"><i class="fas fa-chevron-right"></i></span></li>
                        <li><a href="{{url('/store')}}"><i class="fas fa-store"></i> Tienda</a></li>
                        <li><span class="next"><i class="fas fa-chevron-right"></i></span></li>
                        <li><a href="{{url('/store')}}"><i class="far fa-folder"></i> {{$product->category->name}}</a></li>
                        @if($product->subCategory_id != 0)
                        <li>
                            <li><span class="next"><i class="fas fa-chevron-right"></i></span></li>
                            <a href="{{url('/store')}}"><i class="far fa-folder"></i> {{$product->subCategory->name}}</a>
                        <li>
                            @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection