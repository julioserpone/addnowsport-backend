@extends('emails.master')
@section('contenido')
<h2>{{ trans('emails.cuentas.reestablecer_password') }}</h2>

<div>
    {{ trans('emails.cuentas.resetear_password_msg01', ['usuario' => $data['nombre']]) }}

    {!! Html::link(route('password/reset/',[$token]), trans('emails.cuentas.reestablecer_password')) !!}
</div>
@stop
