@extends('layouts.admin.master')
@section('active-productoras')
    active open
@endsection
@section('title', 'Panel de Administraciòn')

@section('styles')
    {!! Html::style('assets/packet/bower_components/sweetalert/dist/sweetalert.css') !!}
    {!! Html::style('assets/packet/bower_components/DataTables/media/css/dataTables.bootstrap.min.css') !!}
@endsection

@section('scripts')

    {!! Html::script('assets/packet/bower_components/sweetalert/dist/sweetalert.min.js') !!}
    {!! Html::script('assets/packet/bower_components/DataTables/media/js/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/packet/bower_components/DataTables/media/js/dataTables.bootstrap.min.js') !!}
@endsection

@section('run-scripts')

    <script>
        jQuery(document).ready(function() {
            Main.init();
        });
    </script>
@endsection


@section('content')
    {!! Html::script('js/administrador/main.js') !!}
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {display:none;}

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #f3013b;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #f30e40;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
        <div class="col-md-12">
            <div clas="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="background: rgba(32, 32, 36, 0.49);">
                                <div style="color: black; font-size: 26px;">
                                    <i class="fa fa-flag" aria-hidden="true" style="margin-left:10px;"></i> <strong> Usuarios</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" style="width: 96%;margin: 0% 0% 0% 2%;">
                            <div class="row">
                                <div class="box">
                                    <div class="box-body" style="padding: -5% 0 0 -5%;">
                                        <div id="tablainscripciones_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                            <div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
                                                <div class="col-sm-12">
                                                    <table id="tablainscripciones" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                                        <thead>
                                                        <tr role="row" style ="background: #424242;color: white;">
                                                            <th class="sorting_asc" tabindex="0" aria-controls="tablainscripciones" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                                                Nombre
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="tablainscripciones" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                                                Apellido
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="tablainscripciones" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                                                Correo
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="tablainscripciones" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                                                Nacimiento
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="tablainscripciones" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                                                Telefono
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="tablainscripciones" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                                                Pais
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="tablainscripciones" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                                                Identificacion
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="tablainscripciones" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                                                Proveedor
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="tablainscripciones" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                                Productoras
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="tablainscripciones" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                                                Acciones
                                                            </th>
                                                            <th>MA</th>
                                                            <th>SP</th>
                                                            <th>PR</th>
                                                            <th>US</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($usuarios as $usuario)
                                                            <tr role="row" class="odd">
                                                                <td>{{e($usuario->nombre)}}</td>
                                                                <td>{{e($usuario->apellido)}}</td>
                                                                <td>{{e($usuario->correo)}}</td>
                                                                <td>{{e($usuario->fecha_nacimiento)}}</td>
                                                                <td>{{e($usuario->telefono)}}</td>
                                                                <td>{{e($usuario->pais)}}</td>
                                                                <td>{{e($usuario->identificacion)}}</td>
                                                                <td>{{e($usuario->proveedor)}}</td>
                                                                <td><div id="usuario_{{$usuario->id}}">0</div></td>
                                                                <td class="col-md-3">

                                                                    <a onclick="nuevaProductora({{$usuario->id}})">
                                                                        <i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i>
                                                                    </a>

                                                                    <a href="{{route('administrador/modificar-productora')}}">
                                                                        <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                                                                    </a>

                                                                    <a href="{{route('administrador/eliminar-productora')}}">
                                                                        <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <label class="switch">
                                                                        <input type="checkbox" checked>
                                                                        <div class="slider round"></div>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <label class="switch">
                                                                        <input type="checkbox" checked>
                                                                        <div class="slider round"></div>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <label class="switch">
                                                                        <input type="checkbox" checked>
                                                                        <div class="slider round"></div>
                                                                    </label>
                                                                </td>
                                                                <td>
                                                                    <label class="switch">
                                                                        <input type="checkbox" checked>
                                                                        <div class="slider round"></div>
                                                                    </label>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(function () {
                    $('#tablainscripciones').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false
                    });
                });
            </script>
@stop

