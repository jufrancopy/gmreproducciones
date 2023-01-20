@extends('admin.master')

@section('title', 'Agregar Slider')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{'/admin/sliders/'}}"><i class="fas fa-images"></i> Sliders</a>
</li>

@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-plus-circle"></i>Agregar Slider</h2>
                </div>
                <div class="inside">
                    @if(kvfj(Auth::user()->permissions, 'slider_add'))
                    {!!Form::open(['url'=>'admin/slider/add', 'files'=>true])!!}
                    <label for="name">Nombre:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>

                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>

                    <label for="module" class="mtop16">Visible:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!!Form::select('visible', ['0' => 'No visible', '1' => 'Visible'],1,['class' =>
                        'form-select'])!!}
                    </div>

                    <label for="module" class="mtop16">Imagen Destacada:</label>
                    <div class="form-file">
                        {!! Form::file('img', ['class'=>'form-control',
                        'id'=>'customFile',
                        'accept'=>'image/*',
                        'lang'=>'es',]) !!}
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-12">
                            <label for="content">Contenido</label>
                            {!! Form::textarea('content', null, ['class'=>'form-control', 'id'=>'editor', 'rows'=>5])
                            !!}
                        </div>
                    </div>

                    <label for="name">Orden de Slider:</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-keyboard"></i>
                        </span>
                        {!! Form::number('s_order', null, ['class'=>'form-control', 'min'=>'0']) !!}
                    </div>

                    <div class="row mtop16">
                        <div class="col md-12">
                            {!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
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
                    <h2 class="title"><i class="far fa-folder-open"></i> Sliders</h2>
                </div>
                <div class="inside">
                    <table class="table">
                        <thead>
                            <tr>
                                <td width="180">Imagen</td>
                                <td>Nombre</td>
                                <td>Contenido</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider )
                            <tr>
                                <td width="50">
                                    <img src="{{ url('/uploads/'.$slider->file_path.'/'.$slider->file_name) }}"
                                        class="img-fluid">
                                </td>
                                <td>{{ $slider->name }}</td>
                                <td>
                                    <div class="slider_content">{!! html_entity_decode($slider->content) !!} </div>
                                </td>
                                <td>
                                    <div class="opts">

                                        @if(kvfj(Auth::user()->permissions, 'slider_edit'))
                                        <a href="{{url('/admin/slider/'.$slider->id.'/edit')}}" data-toogle="tooltip"
                                            data-toggle="tooltip" data-placement="top" title="Editar"><i
                                                class="fas fa-edit"></i>
                                        </a>
                                        @endif

                                        @if(kvfj(Auth::user()->permissions, 'slider_delete'))
                                        <a href="#" data-path="admin/slider" data-action="delete" data-object={{
                                            $slider->id
                                            }} data-toggle="tooltip" data-placement="top"
                                            title="Eliminar" class="btn_deleted"><i class="fas fa-trash-alt"></i>
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