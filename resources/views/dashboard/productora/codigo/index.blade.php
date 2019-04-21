@extends('layouts.admin.master')

@section('active_codigo')
    active open
@endsection
@section('title', 'Panel de Administraciòn')

@section('dashboard')
@stop

@section('content')
    <div class="col-md-12">
        <div clas="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div style="background: rgba(32, 32, 36, 0.49);">
                            <div style="color: black; font-size: 26px;">
                                <i class="fa fa-tags" aria-hidden="true" style="margin-left:15Px;"></i> <strong> CODIGO </strong> de DESCUENTOS

                                <h4 style="margin-left:10px; padding-bottom: 10px;"> Utilice esta herramienta para realizar descuentos o ventas por fuera de nuestro sistema.</h4>

                            </div>
                        </div>
                    </div>

                    <h4 style="margin-left:10px;"> El codigo que genere representa un importe, que le sera bonificado al usuario en el proceso de pago de inscripcion, en cualquier competencia realizada pr su productora de eventos..</h4>
                    <div class="col-md-12" style="    background: rgba(94, 174, 187, 0.49);
                                                        padding: 6px 0 10px 13px;
                                                        width: 98%;
                                                        margin-left: 1%;">
                        <div >
                            <div class="col-md-1"  style="margin-right: 1%;">
                                <div class="row">
                                    Codigo <br>
                                    <div class="input-group">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"  style="margin-right: 1%;">
                                <div class="row">
                                    Descuento <br>
                                    <div class="input-group">
                                        <input type="number" class="form-control">
                                        <span class="input-group-addon">%</span>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-2"  style="margin-right: 1%;">
                                <div class="row">
                                    Vencimiento <br>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker">
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-2"  style="margin-right: 1%;">
                                <div class="row">
                                    Competencia <br>
                                    <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-2" style="margin-right: 1%;">
                                <div class="row">
                                    Fecha Competencia <br>
                                    <select class="form-control">
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-1" style="margin-right: 1%;">
                                <div class="row">
                                    Limite de uso <br>
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-1" style="margin-right: 1%;">
                                <div class="row">
                                    Limite por Usuario <br>
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-1" style="margin-right: 1%;">
                                <div class="row">
                                    <button style="margin-top: 13px;"type="button" class="btn btn-block btn-danger btn-lg">Crear</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" style="width: 96%;margin: 1% 0% 0% 2%;">
                        <div class="row">
                            <div class="box">
                                <div class="box-body" style="padding: -5% 0 0 -5%;">
                                    <div style="color: black; font-size: 26px;">
                                        <i class="fa fa-wrench" aria-hidden="true" style="margin-left: 15px;"></i>
                                        <strong> ADMINISTRADOR </strong> DE CODIGOS GENERADOS
                                        <div class="col-md-12">
                                            <div >
                                                <div class="col-md-3"  style="margin-right: 1%;">
                                                    <div class="row">
                                                            <input type="text" placeholder="Ingrese codigo" class="form-control">


                                                    </div>
                                                </div>
                                                <div class="col-md-2"  style="margin-right: 1%;">
                                                    <div class="row">
                                                            <select class="form-control">
                                                                <option>Tipo de Codigo</option>
                                                                <option>option 1</option>
                                                            </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-2"  style="margin-right: 1%;">
                                                    <div class="row">
                                                        <select class="form-control">
                                                            <option>Fecha</option>
                                                            <option>26/11/1993</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-2"  style="margin-right: 1%;">
                                                    <div class="row">

                                                        <select class="form-control">
                                                            <option>Estado</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-1" style="margin-right: 1%;">
                                                    <div class="row">
                                                        <button style="margin-top: -5px;"type="button" class="btn btn-block btn-danger btn-lg">GO!</button>

                                                    </div>
                                                </div>
                                                <div class="col-md-1" style="margin-right: 1%;">
                                                    <div class="row">
                                                        <button style="margin-top: -5px;background: grey;"type="button" class="btn btn-block btn-danger btn-lg">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="tablacodigos_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                        <div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row">
                                            <div class="col-sm-12">
                                                <table id="tablacodigos" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                                    <thead>
                                                    <tr role="row" style ="background: #424242;color: white;">
                                                        <th class="sorting_asc" tabindex="0" aria-controls="tablacodigos" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                                           Codigo
                                                        </th>
                                                        <th>
                                                            Tipo
                                                        </th>
                                                        <th >
                                                            Valor
                                                        </th>
                                                        <th>
                                                            Creado
                                                        </th>
                                                        <th  >
                                                            Vencimiento
                                                        </th>
                                                        <th style="width: 15%;">
                                                            Competencia
                                                        <th>
                                                            Usos
                                                        </th>
                                                        <th>
                                                            Estado
                                                        </th>
                                                        <th>
                                                            Detalles
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <tr role="row" class="odd">
                                                        <td>WFVjPqqQ</td>
                                                        <td>Descuento</td>
                                                        <td>$ 220.00</td>
                                                        <td>26/11/1993</td>
                                                        <td>26/11/2020</td>
                                                        <td>La mejor de todas</td>
                                                        <td>25</td>
                                                        <td>
                                                            <label class="switch">
                                                                <input type="checkbox" checked>
                                                                <div class="slider round"></div>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-5">
                                                                <div class="col-md-6">
                                                                    <i class="fa fa-list-alt fa-2x" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr role="row" class="odd">
                                                        <td>WFVjPqqQ</td>
                                                        <td>Descuento</td>
                                                        <td>$ 220.00</td>
                                                        <td>26/11/1993</td>
                                                        <td>26/11/2020</td>
                                                        <td>La mejor de todas</td>
                                                        <td>25</td>
                                                        <td>
                                                            <label class="switch">
                                                                <input type="checkbox" checked>
                                                                <div class="slider round"></div>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-5">
                                                                <div class="col-md-6">
                                                                    <i class="fa fa-list-alt fa-2x" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr role="row" class="odd">
                                                        <td>WFVjPqqQ</td>
                                                        <td>Descuento</td>
                                                        <td>$ 220.00</td>
                                                        <td>26/11/1993</td>
                                                        <td>26/11/2020</td>
                                                        <td>La mejor de todas</td>
                                                        <td>25</td>
                                                        <td>
                                                            <label class="switch">
                                                                <input type="checkbox" checked>
                                                                <div class="slider round"></div>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-5">
                                                                <div class="col-md-6">
                                                                    <i class="fa fa-list-alt fa-2x" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
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
                $('#tablacodigos').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });
        </script>
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
@stop