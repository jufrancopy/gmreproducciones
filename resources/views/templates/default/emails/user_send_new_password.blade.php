@extends('emails.master')
@section('content')

<p>Hola: <span>{{$name}}</span></p>
<p>Esta es la nueva contraseña que ha solicitado para restablecer su cuenta.</p>
<h2>{{$password}}</h2>
<p>Para iniciar sesión, haga click en el siguiente boton.</p>
<p>{{url('/login')}}</p>

@endsection