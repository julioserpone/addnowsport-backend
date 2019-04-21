@extends('layouts.admin.master')
@section('active-lista_inscriptos')
active open
@endsection
@section('styles')
{!! Html::style('assets/packet/bower_components/sweetalert/dist/sweetalert.css') !!}
{!! Html::style('assets/packet/bower_components/DataTables/media/css/dataTables.bootstrap.min.css') !!}
@endsection

@section('scripts')

{!! Html::script('assets/packet/bower_components/sweetalert/dist/sweetalert.min.js') !!}
{!! Html::script('assets/packet/bower_components/DataTables/media/js/jquery.dataTables.min.js') !!}
{!! Html::script('assets/packet/bower_components/DataTables/media/js/dataTables.bootstrap.min.js') !!}
@endsection


@section('content')
<div clas="row">
    <div class="col-md-12" style="background: rgba(32, 32, 36, 0.49);">
        <div class="col-md-12">
            <div class="col-md-7" style="color: black; font-size: 26px; padding: 1% 0% 10px 0%;">
                <i class="fa fa-database" aria-hidden="true" style="margin-left: 15px;"></i>
                <strong> ADMINISTRADOR </strong> DE INSCRIPCIONES
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 clo-md-12 col-lg-12">
        <div class="panel panel-default">
            <div class="panel-footer">
                {!! Form::open(['url'=>'/', 'id'=> 'buscar-inscriptos']) !!}
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            {!! Form::select('productora', [], null,
                            ['class' => 'form-control', 'id' => 'productora',
                            'required' => false, 'autocomplete' => 'off']) !!}
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            {!! Form::select('competencia', [], null,
                            ['class' => 'form-control', 'id' => 'competencia',
                            'required' => false, 'autocomplete' => 'off']) !!}
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            {!! Form::label('pre_comp', 'predefinir competencia',
                            ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-sm-6 col-md-1 col-lg-1">
                            {!! Form::checkbox('pre_comp', 1, null,
                            ['class' => 'form-control', 'id' => 'pre_comp']) !!}
                        </div>

                        <div class="col-sm-12 col-md-2 col-lg-2">
                            {!! Form::text('inscriptos', 'Incriptos: 36', 
                            ['class' => 'form-control', 'id' => 'asunto',
                            'placeholder' => 'Inscriptos', 'required' => false,
                            'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12 col-md-2 col-lg-2">
                            {!! Form::text('buscar', '', 
                            ['class' => 'form-control', 'id' => 'buscar',
                            'placeholder' => 'Ingresar DNI o N de Corredor',
                            'required' => false, 'autocomplete' => 'off']) !!}
                        </div>
                        <div class="col-sm-12 col-md-2 col-lg-2">
                            {!! Form::select('fecha', [], null,
                            ['class' => 'form-control', 'id' => 'fecha',
                            'required' => false, 'autocomplete' => 'off']) !!}
                        </div>
                        <div class="col-sm-12 col-md-2 col-lg-2">
                            {!! Form::select('distancia', [], null,
                            ['class' => 'form-control', 'id' => 'distancia',
                            'required' => false, 'autocomplete' => 'off']) !!}
                        </div>
                        <div class="col-sm-12 col-md-2 col-lg-2">
                            {!! Form::select('categoria', [], null,
                            ['class' => 'form-control', 'id' => 'categoria',
                            'required' => false, 'autocomplete' => 'off']) !!}
                        </div>
                        <div class="col-sm-12 col-md-1 col-lg-1">
                            {!! Form::select('sexo', [], null,
                            ['class' => 'form-control', 'id' => 'sexo',
                            'required' => false, 'autocomplete' => 'off']) !!}
                        </div>
                        <div class="col-sm-12 col-md-1 col-lg-1">
                            {!! Form::select('estado', [], null,
                            ['class' => 'form-control', 'id' => 'estado',
                            'required' => false, 'autocomplete' => 'off']) !!}
                        </div>
                        <div class="col-sm-12 col-md-2 col-lg-2 ">
                            {!! Form::submit('GO!', 
                            ['class' => 'btn btn-danger pull-right']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                <div id="tablacodigos_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row">
                        <div class="col-sm-12">
                            <table id="tablainscriptos" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                    <tr role="row" style ="background: #424242;color: white;">
                                        <th class="sorting_asc" tabindex="0" aria-controls="tablacodigos"
                                            rowspan="1" colspan="1" aria-sort="ascending" 
                                            aria-label="Rendering engine: activate to sort column descending">
                                            Seccion 1
                                        </th>
                                        <th>
                                            Seccion 2
                                        </th>
                                        <th>
                                            Seccion 3
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr role="row" class="odd">
                                        <td>Seccion 1</td>
                                        <td>Seccion 2</td>
                                        <td>Seccion 3</td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td>Seccion 1</td>
                                        <td>Seccion 2</td>
                                        <td>Seccion 3</td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td>Seccion 1</td>
                                        <td>Seccion 2</td>
                                        <td>Seccion 3</td>
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
@stop

@section('run-scripts')
<script>
    $(document).ready(function () {
        Main.init();
    });
    $(function () {
        $('#tablainscriptos').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
@endsection