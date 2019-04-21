@extends('emails.master')
@section('contenido')
<h2>{{ trans('emails.cuentas.validar_email') }}</h2>

<div>
    Para validar su email, dirijase a la siguiente dirección:
    {!! Html::link(route('activacion.usuario',[$data['id'],$data['hash_activacion']]), trans('emails.cuentas.validar_email')) !!}
</div>
@stop