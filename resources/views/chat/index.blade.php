@extends('layouts.admin.master')

@section('title', 'Chat')

@section('styles')
{!! Html::style('css/chat/chat.css') !!}
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 clo-md-8 col-lg-8">
            <div class="panel panel-info panel-principal">
                <div class="panel-heading">
                    <i class="fa fa-commenting" aria-hidden="true"></i>BOX DE MENSAJES
                </div>
                <div class="panel-body panel-cuerpo">
                    <ul class="chat"></ul>
                </div>
                <div class="panel-footer">
                    {!! Form::open(['route'=>'sendmessage', 'id'=> 'send-message']) !!}
                    {!! Form::hidden('usuario_remitente', 
                    $usuario->id, ['id' => 'usuario_remitente']) !!}
                    {!! Form::hidden('usuario_destinatario', 
                    null, ['id' => 'usuario_destinatario']) !!}
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="input-group">
                                {!! Form::text('mensaje', null, 
                                ['class' => 'form-control', 'id' => 'message',
                                'placeholder' => 'Mensaje', 'required' => true,
                                'autocomplete' => 'off']) !!}
                                <span class="input-group-btn">
                                    {!! Form::submit('GO', 
                                    ['class' => 'btn btn-success']) !!}
                                </span>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4 clo-md-4 col-lg-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div id="user_connected"></div>
                </div>
                <div class="panel-body">
                    <div id="users_connected"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
{!! Html::script('//code.jquery.com/jquery-migrate-1.2.1.min.js') !!}
{!! Html::script('https://cdn.socket.io/socket.io-1.3.4.js') !!}
{!! Html::script('js/chat/chat.js') !!}
@stop

