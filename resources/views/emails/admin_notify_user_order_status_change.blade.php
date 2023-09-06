@extends('emails.master')
@section('content')

    <p>Hola: <span>{{ $name }}</span></p>
    <p>Su orden #{{ $o_number }} fue marcada como
    <p>{{ getOrderStatus($status) }}</p>.</p>

    @if ($status == 6)
        <p>Muchas gracias por su confianza</p>
    @endif
@stop
