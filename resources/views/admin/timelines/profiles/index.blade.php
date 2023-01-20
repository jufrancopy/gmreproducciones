@extends('admin.master')

@section('title', 'Timelines')

@section('breadcrumb')

<li class="breadcrumb-item">
    <i class="fas fa-boxes"> Linea de Tiempo</i>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title">
                <i class="fas fa-boxes"> Linea de Tiempo</i>
            </h2>
        </div>
        <div class="inside">
            <div class="btns">
                <a href="{{ route('timeline-profiles.create') }}" class="btn btn-success"><i
                        class="fas fa-plus-circle"></i>
                    Nueva Liea de Tiempo
                </a>
            </div>
            <table class="table table-striped mtop16">
                <thead>
                    <tr>
                        <td>Perfil</td>
                        <td>Descripción</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($timelinesProfiles as $timelinesProfile)
                    <td width="50">{{$timelinesProfile->name}}</td>
                    <td>{!! html_entity_decode($timelinesProfile->description) !!}</td>
                    <td>
                        <div class="opts">
                            <a href="{{route('timeline-profiles.edit', $timelinesProfile->id)}}" data-toggle="tooltip"
                                data-placement="top" title="Editar"><i class="fas fa-edit"></i>
                            </a>
                            {!! Form::open(['route' => ['timeline-profiles.destroy', $timelinesProfile->id], 'method' =>
                            'DELETE', 'style'=>'display:inline-block']) !!}
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Estas seguro de eliminar a {{$timelinesProfile->name}}. Si lo eliminas también eliminarás los datos asociados a el.')"
                                data-toggle="tooltip" data-placement="top" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            {!! Form::close() !!}
                            <a href="{{url('/admin/timelines-list', $timelinesProfile->id)}}" data-toggle="tooltip"
                                data-placement="top" title="Editar">
                                <i class="fas fa-photo-video btn btn-sm btn-info"></i>
                            </a>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
                <tr>
                    <td colspan="3">{{ $timelinesProfiles->render() }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection