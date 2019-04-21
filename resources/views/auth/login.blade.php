@extends('layouts.principal')

@section('title')
Login
@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="featured-box featured-box-primary align-left mt-xlg">
                <div class="box-content">
                    @include('templates.mensajes')
                    @include('templates.errores')
                    <h4 class="heading-primary text-uppercase mb-md">Iniciar Sesión</h4>
                    {!! Form::open(['url' => 'login', 'class' => 'form',
                    'role' => 'form', 'id' => 'formLogin', 'method'=> 'post']) !!}
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Form::label('email', 'Email') !!}
                                {!! Form::email('email', '', 
                                ['class' => 'form-control input-lg',
                                'autocomplete' => 'off', 'required' => true]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! Html::link('password/reset',
                                '¿Olvidaste tu contraseña?', ['class'=>'pull-right']) !!}
                                {!! Form::label('password', 'Contraseña') !!}
                                {!! Form::password('password', 
                                ['class'=> 'form-control input-lg', 'required' => true]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span class="remember-box checkbox">
                                <div class="checkbox">
                                    <label>{!! Form::checkbox('remember') !!} Recordarme</label>
                                </div>
                            </span>
                        </div>
                        <div class="col-md-6">                            
                            {!! Form::submit('Ingresar',
                            ['class' => 'btn btn-primary pull-right mb-xl',
                            'data-loading-text' => 'Cargando...']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="featured-box featured-box-primary align-left mt-xlg">
                <div class="box-content">
                    <h5 class="heading-primary text-uppercase mb-md">Ingrese con</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{!! url('social/facebook') !!}" title="Facebook">
                                {!! Html::image('images/social/facebook.png', 
                                'facebook', ['class' => 'img-responsive center-block',
                                'style' =>'width:48px; height:48px']) !!}
                            </a>
                        </div>
<!--                        <div class="col-md-4">
                            <a href="{!! url('social/twitter') !!}" title="Twitter">
                                {!! Html::image('images/social/twitter.png', 
                                'twitter', ['class' => 'img-responsive center-block',
                                'style' =>'width:48px; height:48px']) !!}
                            </a>
                        </div>-->
                        <div class="col-md-6">
                            <a href="{!! url('social/google') !!}" title="Google">
                                {!! Html::image('images/social/google-plus.png', 
                                'google-plus', ['class' => 'img-responsive center-block',
                                'style' =>'width:48px; height:48px']) !!}
                            </a>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('layouts.message')
