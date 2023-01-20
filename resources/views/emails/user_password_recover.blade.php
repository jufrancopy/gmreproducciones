@extends('emails.master')
@section('content')

<p>Hola: <span>{{$name}}</span></p>
<p>Este es un correo electrónico que le ayudará a reestablecer nuevamente su contraseña. Para continuar, haga click en
    el siguiente botón e ingrese el siguiente código: <h3>{{$code}}</h3></p>
<p>
    <a href="{{url('/reset?email='.$email)}}" 
        style="
            display:inline-block;
            width:100%;
            text-align: center; 
            background-color:#2caaff;
            color:#fff;
            padding:8px;
            border-radius:4px;
            text-decoration:none ">
        Recuperar Contraseña
    </a>
</p>
<p>Si el botón anterior no le funciona, copie y pegue la url de abajo en su navegador.</p>
<p>{{url('/reset?email='.$email)}}</p>

@endsection