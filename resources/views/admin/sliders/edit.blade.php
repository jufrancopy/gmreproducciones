@extends('admin.master')

@section('title', 'Módulo de Sliders')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ '/admin/sliders' }}"><i class="fas fa-images"></i> Sliders</a>
    </li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if (kvfj(Auth::user()->permissions, 'slider_edit'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="far fa-edit"></i>Agregar Slider</h2>
                        </div>
                        <div class="inside">
                            {!! Form::open(['url' => '/admin/slider/' . $slider->id . '/edit']) !!}
                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-keyboard"></i>
                                </span>
                                {!! Form::text('name', $slider->name, ['class' => 'form-control']) !!}
                            </div>

                            <label for="module" class="mtop16">Visible:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-keyboard"></i>
                                </span>
                                {!! Form::select('visible', ['0' => 'No visible', '1' => 'Visible'], $slider->status, [
                                    'class' => 'form-select',
                                ]) !!}
                            </div>

                            <label for="module" class="mtop16">Imagen Destacada:</label>
                            <div class="row col-md-4">
                                <img src="{{ url('/uploads/' . $slider->file_path . '/' . $slider->file_name) }}"
                                    class="img-fluid">
                            </div>


                            <label for="content" class="mtop16">Contenido</label>
                            <div class="input-group" id="editor">
                                <span class="input-group-text" id=bassic-addon1>
                                    <i class="fas fa-keyboard"></i>
                                </span>
                                {!! Form::textarea('content', html_entity_decode($slider->content), ['class' => 'form-control', 'rows' => 5]) !!}
                            </div>


                            <label for="name">Orden de Slider:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-keyboard"></i>
                                </span>
                                {!! Form::number('s_order', $slider->s_order, ['class' => 'form-control', 'min' => '0']) !!}
                            </div>

                            <div class="row mtop16">
                                <div class="col md-12">
                                    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
