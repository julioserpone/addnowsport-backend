@extends('layouts.principal')

@section('title')
Registro
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="featured-box featured-box-primary align-left mt-xlg">
                <div class="box-content">
                    <h4 class="heading-primary text-uppercase mb-md">¿Sos Nuevo? Registrate</h4>
                    {!! Form::open(['url' => 'register', 'class' => 'form',
                    'id' => 'frmSignIn', 'method'=> 'post']) !!}
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('nombre', 'Nombres') !!}
                                {!! Form::text('nombre', '', 
                                ['class' => 'form-control input-lg',
                                'autocomplete' => 'off', 'required' => true,
                                'autofocus' => 'autofocus']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('apellido', 'Apellidos') !!}
                                {!! Form::text('apellido', '', 
                                ['class' => 'form-control input-lg',
                                'autocomplete'=> 'off', 'required' => true]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">                            
                                {!! Form::label('fecha_nacimiento', 'Fecha de nacimiento') !!}
                                {!! Form::text('fecha_nacimiento', '', 
                                ['class' => 'form-control input-lg datepicker',
                                'autocomplete' => 'off', 'required' => true]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('correo', 'Email') !!}
                                {!! Form::email('correo', '', 
                                ['class' => 'form-control input-lg',
                                'autocomplete'=> 'off', 'required' => true]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('correo_confirmation',
                                'Confirmación de Email') !!}
                                {!! Form::email('correo_confirmation', '', 
                                ['class' => 'form-control input-lg',
                                'autocomplete'=> 'off', 'required' => true]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                {{ Form::label('clave', 'Contraseña') }}
                                {!! Form::password('clave', 
                                ['class'=> 'form-control input-lg']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('clave_confirmation',
                                'Confirmación de Contraseña') !!}
                                {!! Form::password('clave_confirmation',
                                ['class'=> 'form-control input-lg']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::submit('Registrarme',
                                ['class' => 'btn btn-primary pull-right mb-xl',
                                'data-loading-text' => 'Cargando...']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('layouts.message')

@section('script')
<script>
    $(document).ready(function () {
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true
        });
    });
</script>
@endsection
