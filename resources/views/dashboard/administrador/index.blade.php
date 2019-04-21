@extends('layouts.admin.master')

@section('active-panel')
active open
@endsection

@section('content')
{{-- Html::script('js/administrador/main.js') --}}
<!--<style>
    button.accordion {
        background-color: rgba(26, 31, 32, 0.95);
        color: rgba(250, 246, 245, 1);
        cursor: pointer;
        padding: 13px;
        width: 100%;
        border: grey 1px solid;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
    }

    button.accordion.active, button.accordion:hover {

    }

    div.panel {
        padding: 0 18px;
        display: none;
        background-color: white;
    }

    div.panel.show {
        display: block;
        margin-bottom:0px;
    }
</style>-->
<!--<div class="col-md-12">
    <div clas="row">
        <div class="col-md-8">
            <div style="background: rgba(32, 32, 36, 0.49);">
                <div style="color: black; font-size: 26px;">
                    {{trans('administrador.panel_addnow')}}
                </div>
            </div>

            <div class="box">
                <div class="box-profile">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>{{trans('administrador.competencias_en_calendario')}}</td>
                                <td>48</td>
                            </tr>
                            <tr>
                                <td>{{trans('administrador.competencias_en_curso')}}</td>
                                <td>32</td>
                            </tr>
                            <tr>
                                <td>{{trans('administrador.competencias_finalizada')}}</td>
                                <td>16</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div style="background: rgba(32, 32, 36, 0.49);">
                <div style="color: black; font-size: 26px;">
                    {{trans('administrador.estado_usuarios')}}
                </div>
            </div>
            <div class="box" style="background: rgba(32, 32, 36, 0.49);">
                <div class="box-profile">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>{{trans('administrador.usuarios_registrados')}}</td>
                                <td>16</td>
                            </tr>
                            <tr>
                                <td>{{trans('administrador.usuarios_online')}}</td>
                                <td>16</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <?php $i = 0; ?>
            @foreach($competencias as $competencia)
            <div>
                <button class="accordion" id="accordio_{{$i}}" style="height: 30px;">
                    <div style="margin: -1% 0% 0% 0%;">
                        Competencias a pata.
                        <i id="accordio_{{$i}}_icon" class="fa fa-chevron-down pull-right" aria-hidden="true"></i>
                    </div>
                </button>
                <div class="panel">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Mataron</td>
                                <td class="pull-right">
                                    <a href="">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>
                                    <a href="">
                                        <i class="fa fa-times-circle"></i>
                                    </a>
                                </td>
                                <td class="pull-right">8</td>
                            </tr>
                            <tr>
                                <td>Running</td>

                                <td class="pull-right">
                                    <a href="">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>
                                    <a href="">
                                        <i class="fa fa-times-circle"></i>
                                    </a>
                                </td>
                                <td class="pull-right">18</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php $i++; ?>
            @endforeach
        </div>

        <div class="col-md-4">
            <div class="row">
                <div class="box">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
                    <input type="text" class="form-control" placeholder="{{trans('administrador.disciplina')}}"  name="disciplina" id="disciplina">

                    <button class="btn pull-right" onclick="agregarDisciplina()">{{trans('generals.agregar')}}</button>

                    {!! Form::select('selectDisciplina', $disciplinas_array, 0, ['class' => 'form-control select2 select2-hidden-accessible', 'id' => 'selectDisciplina']) !!}

                    <input type="text" class="form-control" placeholder="{{trans('administrador.subdisciplina')}}" name="subdisciplina" id="subdisciplina">

                    <button  class="btn pull-right" onclick="agregarDisciplina()">{{trans('generals.agregar')}}</button>
                </div>
            </div>
            <div class="row">
                <div class="box">
                    <div style="background: rgba(32, 32, 36, 0.49);">
                        <div style="color: black; font-size: 26px;">
                            {{trans('administrador.competencias_tendencias')}}
                        </div>
                    </div>

                    <table class="table">
                        <tbody>
                            <tr>
                                <td><img src="{{ asset('adminlte/img/photo1.png') }}" class="img-circle" alt="avatar" width="20px;" height="20px;" /></td>
                                <td>Freire</td>
                                <td>358</td>
                                <td class="pull-right">$2400,00
                                </td>
                            </tr>
                            <tr>
                                <td><img src="{{ asset('adminlte/img/photo2.png') }}" class="img-circle" alt="avatar" width="20px;" height="20px;" /></td>
                                <td>Tandill</td>
                                <td>290</td>
                                <td class="pull-right">$2100,00
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>-->
<!--<script>

    $('.accordion').click(function () {
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
        var act = $(this).find('i');

        if (act.hasClass('fa-chevron-down'))
            act.removeClass('fa-chevron-down').addClass('fa-chevron-up');
        else
            act.removeClass('fa-chevron-up').addClass('fa-chevron-down');

    });
</script>-->
<div class="row">
    <div class="col-xs-12 col-sm-9 col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a data-toggle="collapse" data-parent="#acordion" href="#acordion-panel"
                           class="lipanel-heading">
                            <i class="fa fa-bar-chart-o" aria-hidden="true" 
                               style="color: #000 !important"></i>
                            <strong>{{trans('administrador.panel_addnow')}}</srong>
                        </a> 
                    </div>
                </div>
            </div>
            <div id="acordion-panel" class="panel-collapse collapse-in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <div class="input-group">
                                {!! Form::text('competencias', null, ['class' => 'form-control',
                                'placeholder' => strtoupper(trans('administrador.competencias_en_calendario')),
                                'readonly' => 'readonly', 'aria-describedby' => 'basic-addon2']) !!}
                                <span class="input-group-addon" id="basic-addon2">48</span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <div class="input-group"> 
                                {!! Form::text('competencias', null, ['class' => 'form-control',
                                'placeholder' => trans('administrador.competencias_en_curso'),
                                'readonly' => 'readonly', 'aria-describedby' => 'basic-addon2']) !!}
                                <span class="input-group-addon" id="basic-addon2">32</span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <div class="input-group"> 
                                {!! Form::text('competencias', null, ['class' => 'form-control',
                                'placeholder' => trans('administrador.competencias_finalizada'),
                                'readonly' => 'readonly', 'aria-describedby' => 'basic-addon2']) !!}
                                <span class="input-group-addon" id="basic-addon2">16</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <a data-toggle="collapse" data-parent="#acordion" href="#acordion-competencias"
                                   class="lipanel-heading">
                                    <strong>COMPETENCIAS POR DISCIPLINAS</srong>
                                </a> 
                            </div>
                        </div>
                    </div>
                    <div id="acordion-competencias" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                                Competencia a pie</a>
                                        </h4>
                                    </div>
                                    <div id="collapse1" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Mataron</td>
                                                        <td class="pull-right">
                                                            <a href="">
                                                                <i class="fa fa-pencil-square"></i>
                                                            </a>
                                                            <a href="">
                                                                <i class="fa fa-times-circle"></i>
                                                            </a>
                                                        </td>
                                                        <td class="pull-right">8</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Running</td>
                                                        <td class="pull-right">
                                                            <a href="">
                                                                <i class="fa fa-pencil-square"></i>
                                                            </a>
                                                            <a href="">
                                                                <i class="fa fa-times-circle"></i>
                                                            </a>
                                                        </td>
                                                        <td class="pull-right">18</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                                Ciclismo</a>
                                        </h4>
                                    </div>
                                    <div id="collapse2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Ruta</td>
                                                        <td class="pull-right">
                                                            <a href="">
                                                                <i class="fa fa-pencil-square"></i>
                                                            </a>
                                                            <a href="">
                                                                <i class="fa fa-times-circle"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Cross Country</td>
                                                        <td class="pull-right">
                                                            <a href="">
                                                                <i class="fa fa-pencil-square"></i>
                                                            </a>
                                                            <a href="">
                                                                <i class="fa fa-times-circle"></i>
                                                            </a>
                                                        </td>
                                                        <td class="pull-right">5</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                                Multidisciplina</a>
                                        </h4>
                                    </div>
                                    <div id="collapse3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Duatlon</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Triatlon</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                                Motociclismo</a>
                                        </h4>
                                    </div>
                                    <div id="collapse4" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>Motocross</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Enduro Race</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-3 col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                ESTADO DE USUARIOS
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Usuarios Registrados</td>
                            <td class="pull-right">12038</td>
                        </tr>
                        <tr>
                            <td>Usuarios en línea</td>
                            <td class="pull-right">2648</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                AGREGAR DISCIPLINAS
            </div>
            <div class="panel-body">
                {!! Form::open(['route'=>'/', 'id'=> 'disciplinas']) !!}
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            {!! Form::text('disciplina', null, 
                            ['class' => 'form-control', 'id' => 'disciplina',
                            'placeholder' => trans('administrador.disciplina'),
                            'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            {!! Form::button(trans('generals.agregar'), 
                            ['class' => 'btn pull-right btn-primary', 
                            'onclick' => 'agregarDisciplina()' ]) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            {!! Form::select('disciplina', $disciplinas_array, null,
                            ['class' => 'form-control select2 select2-hidden-accessible',
                            'id' => 'disciplina', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            {!! Form::text('subdisciplina', null, 
                            ['class' => 'form-control', 'id' => 'subdisciplina',
                            'placeholder' => trans('administrador.subdisciplina'),
                            'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            {!! Form::button(trans('generals.agregar'), 
                            ['class' => 'btn pull-right btn-primary', 
                            'onclick' => 'agregarDisciplina()' ]) !!}
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                TENDENCIA COMPETENCIAS
            </div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <img src="{{ asset('adminlte/img/photo1.png') }}"
                                     class="img-circle" alt="avatar" width="20px;" height="20px;" />
                            </td>
                            <td>Freire</td>
                            <td>358</td>
                            <td class="pull-right">$2400,00</td>
                        </tr>
                        <tr>
                            <td><img src="{{ asset('adminlte/img/photo2.png') }}"
                                     class="img-circle" alt="avatar" width="20px;" height="20px;" /></td>
                            <td>Tandill</td>
                            <td>290</td>
                            <td class="pull-right">$2100,00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('run-scripts')
<script>
    jQuery(document).ready(function () {
        Main.init();
        //Index.init();
    });
    var oTable = $('#tablacodigos').dataTable();
</script>
@endsection