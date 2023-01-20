@extends('admin.master')

@section('title', 'Timelines')

@section('breadcrumb')

<li class="breadcrumb-item">
    <i class="fas fa-boxes"> Hitos</i>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title">
                <i class="fas fa-boxes"> Hitos</i>
            </h2>
        </div>
        <div class="inside">
            <div class="btns">
                <a href="{{url('/admin/timeline/'.$profileId.'/add')}}" class="btn btn-success"><i
                        class="fas fa-plus-circle"></i>
                    Agregar Hito
                </a>
            </div>
            <h3>{{$timelineProfile->name}}</h3>
            <table class="table table-striped mtop16">
                <thead>
                    <tr>
                        <td>id</td>
                        <td>Imagen</td>
                        <td>Título</td>
                        <td>Fecha</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($timelines as $timeline)
                    <td width="50">{{$timeline->id}}</td>
                    <td width="64">
                        <a href="{{'/uploads/'.$timeline->file_path.'/t_'.$timeline->image}}" data-fancybox="gallery">
                            <img src="{{'/uploads/'.$timeline->file_path.'/t_'.$timeline->image}}" width="64">
                        </a>
                    </td>
                    <td>{{$timeline->title}}</td>
                    <td>{{ Carbon\Carbon::parse($timeline->date)->formatLocalized('%d de %B, %Y')}}</td>
                    <td>
                        
                        <button  class="btn btn-info fas fa-edit onclick=" onclick="location.href='{{url('/admin/timeline/'.$timeline->id.'/edit')}}';" ></button>

                        {!! Form::open(['url' =>
                        ['/admin/timeline/'.$timeline->id.'/delete'],'style'=>'display:inline-block']) !!}
                        <button class="btn btn-sm btn-danger"i
                            onclick="return confirm('Estas seguro de eliminar a {{$timeline->title}}. Si lo eliminas también eliminarás los datos asociados a el.')"
                            data-toggle="tooltip" data-placement="top" title="Eliminar">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                <tr>
                    <td colspan="5">{{ $timelines->render() }}</td>
                </tr>

            </table>

        </div>
    </div>
</div>
@endsection