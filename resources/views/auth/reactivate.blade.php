@extends('layouts.principal')

@section('title')
Reenviar correo de verificación de cuenta
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="featured-box featured-box-primary align-left mt-xlg">
                <div class="box-content">
                    @include('templates.mensajes')
                    @include('templates.errores')
                    <h4 class="heading-primary text-uppercase mb-md text-center">Verificación de cuenta</h4>
                    {!! Form::open(['url' => 'reactivate', 'class' => 'form',
                    'role' => 'form', 'id' => 'formReactivate', 'method'=> 'post']) !!}
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::hidden('usuario_id', $usuario->id )!!}
                                {!! Form::hidden('usuario_correo', $usuario->email )!!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">                            
                            {!! Form::submit('Reenviar Correo',
                            ['class' => 'btn btn-sm btn-primary btn-block']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
