@extends('layouts.principal')

@section('title')
Restablecer Contraseña
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="featured-box featured-box-primary align-left mt-xlg">
                <div class="box-content">
                    <h4 class="heading-primary text-uppercase mb-md">Restablecer Contraseña</h4>
                    <form action="{{ url('/password/reset') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::label('email', 'Email') !!}
                                    {!! Form::email('email', old('email'), 
                                    ['class' => 'form-control input-lg',
                                    'autocomplete' => 'off', 'required' => true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::label('password', 'Contraseña') !!}
                                    {!! Form::password('password', 
                                    ['class'=> 'form-control input-lg', 'required' => true]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::label('password_confirmation',
                                    'Confirmación de Contraseña') !!}
                                    {!! Form::password('password_confirmation',
                                    ['class'=> 'form-control input-lg']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">                            
                                {!! Form::submit('Restablecer Contraseña',
                                ['class' => 'btn btn-primary pull-right mb-xl']) !!}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection