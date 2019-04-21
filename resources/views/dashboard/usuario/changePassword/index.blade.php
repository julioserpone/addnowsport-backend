@extends('layouts.admin.master')

{{--
Atributos para enviar al back
    old_password
    new_password
--}}
@section('active_password')
    active open
@endsection

@section('side-menu')
    @include('dashboard.usuario.help-contacto')
@endsection

@section('content')
    @include('layouts.change_password')
@stop

