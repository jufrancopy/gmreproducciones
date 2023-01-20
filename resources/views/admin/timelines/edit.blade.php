@extends('admin.master')

@section('title', 'Editar Hito')

@section('breadcrumb')
<li class="breadcrumb-item">
    
    <a href="{{url('/admin/timelines-list/'.$timeline->profile_id)}}"><i class="fas fa-boxes"> Hitos</i></a>
</li>
<li class="breadcrumb-item">
    <i class="fas fa-edit"> Editar Hito</i>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-edit"></i>Editar Hito</h2>
                </div>
                <div class="inside">
                    {!!Form::open(['url'=>'admin/timeline/'.$timeline->id.'/edit', 'files'=>true])!!}
                    <div class="row">
                        <div class="col-md-12">
                            <label for="title">Titulo:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                                </div>
                                {!! Form::text('title', $timeline->title, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                       
                        <div class="col-md-4">
                            <label for="image">Imagen:</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    {!! Form::file('image', ['class'=>'custom-file-input', 'id'=>'customFile', 'accept'=>'image/*',
                                    'lang'=>'es']) !!}
                                    <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                                </div>
                            </div>
                        </div>
        
                        <div class="col-md-4">
                            <label for="price">Fecha:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                                </div>
                                {{ Form::date('date', $timeline->date, ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
        
                    {{-- Tercera Fila de Inputs --}}
                    <div class="row mtop16">
                        <div class="col-md-12">
                            <label for="content">Descripción</label>
                            {!! Form::textarea('description', $timeline->description, ['class'=>'form-control', 'id'=>'editor']) !!}
                        </div>
                    </div>
                    {{-- Fin Tercera Fila de Inputs --}}
                    
                    {{-- Boton de Envio --}}
                    <div class="row mtop16">
                        <div class="col md-12">
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
                        </div>
                    </div>
                    {{-- FIn Boton de Envio --}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        {{-- Galería de imágenes --}}
        <div class="div col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="far fa-image"></i> Imagen Destacada</h2>
                    <div class="inside">
                        <img src="{{'/uploads/'.$timeline->file_path.'/'.$timeline->image}}" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="panel shadow mtop16">
                <div class="header">
                    <h2 class="title"><i class="far fa-images"></i> Galería</h2>
                </div>
                <div class="inside timeline_gallery">
                    {!! Form::open(['url'=>'/admin/timeline/'.$timeline->id.'/gallery/add', 'files'=>true, 'id'=>'form_timeline_gallery']) !!}
                    {!! Form::file('file_image', ['id'=>'timeline_file_image', 'accept'=>'image/*', 'required']) !!}
                    {!! Form::close() !!}
                    <div class="btn-submit">
                        <a href="#" id="btn_timeline_file_image"><i class="fas fa-plus-circle"></i></a>
                    </div>
                    <div class="tumbs">
                        @foreach ($timeline->getGallery as $img)
                            <div class="tumb">
                                <a href="{{url('/admin/timeline/'.$timeline->id.'/gallery/'.$img->id.'/delete')}}" data-toogle="tooltip"
                                    data-toggle="tooltip" data-placement="top" title="Eliminar"><i
                                    class="fas fa-trash-alt"></i>
                                </a>
                            <img src="{{ url('/uploads/'.$img->file_path.'/t_'.$img->file_name) }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection