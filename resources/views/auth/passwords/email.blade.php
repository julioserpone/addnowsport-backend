@extends('layouts.principal')

@section('title')
Recuperar Contraseña
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="featured-box featured-box-primary align-left mt-xlg">
                <div class="box-content">
                    <h4 class="heading-primary text-uppercase mb-md">Recuperar Contraseña</h4>
                    <form action="{{ url('/password/email') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="form-group has-feedback">
                                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"/>
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">        
                                <input type="submit" class="btn btn-primary pull-right mb-xl" value="Enviar Link" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('layouts.message')