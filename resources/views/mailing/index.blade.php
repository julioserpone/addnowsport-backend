@extends('layouts.admin.master')

@section('title', 'Mailing')

@section('styles')
{!! Html::style('select2/dist/css/select2.min.css') !!}
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 clo-md-12 col-lg-12">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>MAILING
                </div>

                <div class="panel-body">
                    {!! Form::open(['route'=>'administrador/mailing', 'id'=> 'mailing']) !!}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                {!! Form::select('destinatarios[]', $opciones, null,
                                ['class' => 'form-control advanced-select', 'id' => 'destinatarios',
                                'required' => true, 'autocomplete' => 'off', 'multiple' => 'multiple']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                {!! Form::label('multiusuario', 'Todos los usuarios',
                                ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-sm-12 col-md-9 col-lg-9">
                                {!! Form::checkbox('ind_multiusuario', 1, null,
                                ['class' => 'form-control', 'id' => 'ind_multiusuario']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                {!! Form::text('asunto', null, 
                                ['class' => 'form-control', 'id' => 'asunto',
                                'placeholder' => 'Asunto', 'required' => true,
                                'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                {!! Form::textarea('mensaje', null, 
                                ['class' => 'form-control ckeditor',
                                'id' => 'mensaje', 'required' => true,]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-12 col-md-12 col-lg-12 ">
                                {!! Form::submit('Enviar', 
                                ['class' => 'btn btn-success pull-right']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
</div>
@stop

@section('scripts')
{!! Html::script('ckeditor/ckeditor.js') !!}
{!! Html::script('select2/dist/js/select2.min.js') !!}
<script type="text/javascript">
$('select.advanced-select').select2({
  maximumSelectionLength: 1
});
$('#ind_multiusuario').on( "click", function(){
    var is_checked = $('#ind_multiusuario:checked').length;
    if(is_checked === 1){
        $('select.advanced-select').attr('required', false);
        $('select.advanced-select').attr('disabled', 'disabled');
    }else{
        $('select.advanced-select').attr('required', true);
        $('select.advanced-select').removeAttr('disabled');
    }
});
</script>
@stop

