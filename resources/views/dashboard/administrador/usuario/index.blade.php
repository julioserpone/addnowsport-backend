@extends('layouts.admin.master')
@section('active-usuarios')
    active open
@endsection

@section('run-scripts')

    <script>
        jQuery(document).ready(function() {
            Main.init();
        });
    </script>
@endsection

@section('content')
    <div class="col-md-12">
        <div clas="row">
            <div class="col-md-12">
                <div class="row">

                    <div class="col-md-12" style="width: 96%;margin: 1% 0% 0% 2%;">
                        <div class="row">
                            <div class="box">
                                <div class="box-body" style="padding: -5% 0 0 -5%;">
                                    <div style="color: black; font-size: 26px;">
                                        <div class="col-md-12" style="background: rgba(32, 32, 36, 0.49);">
                                            <div class="col-md-12">
                                                <div class="col-md-7" style="color: black; font-size: 26px; padding: 1% 0% 10px 0%;">
                                                    <i class="fa fa-wrench" aria-hidden="true" style="margin-left: 15px;"></i>
                                                    <strong> ADMINISTRADOR </strong> DE USUARIOS
                                                </div>
                                                <div class="col-md-1" style="background: white;margin-right: 2%;margin-top: 1%;">
                                                    <h5 style="margin-top: 10px;">Usuarios: <strong >500</strong></h5>
                                                </div>
                                                <div class="col-md-1" style="background: white;margin-right: 2%;margin-top: 1%;">
                                                    <h5 style="margin-top: 10px;">On Line:<strong >36</strong></h5>
                                                </div>
                                                <div class="col-md-2" style="background: white;margin-right: 2%;margin-top: 1%;">
                                                    <h5 style="margin-top: 10px;">Selección Realizada: <strong >36</strong></h5>
                                                </div>


                                            </div>
                                        </div>
                                        <br><br>

                                        <div class="col-md-12">
                                            <div >
                                                <div class="col-md-3"  style="margin-right: 1%;">
                                                    <div class="row">
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
                                                            {{trans('administrador.perfil')}}
                                                        </th>
                                                        <th>
                                                            {{trans('administrador.nombre')}}
                                                        </th>
                                                        <th >
                                                            {{trans('administrador.dni')}}
                                                        </th>
                                                        <th>
                                                            {{trans('administrador.email')}}
                                                        </th>
                                                        <th  >
                                                            {{trans('administrador.acceso')}}
                                                        </th>
                                                        <th>
                                                            {{trans('administrador.porductora')}}
                                                        </th>
                                                        <th>
                                                            {{trans('administrador.ma')}}
                                                        </th>
                                                        <th>
                                                            {{trans('administrador.sp')}}
                                                        </th>
                                                        <th>
                                                            {{trans('administrador.pr')}}
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
                                                            <input type="checkbox" class="js-switch red">
                                                        </td>
                                                        <td>
                                                            <i class="fa fa-list-alt fa-2x" aria-hidden="true"></i> <i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
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

@stop