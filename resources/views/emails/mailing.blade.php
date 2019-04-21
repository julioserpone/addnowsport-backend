@extends('emails.master')
@section('contenido')
<h2>Mensaje del Administrador PSP</h2>

<div>
    <p>{!! $mensaje !!}</p>
</div>
@stop