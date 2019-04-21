@extends('layouts.admin.master')

@section('title', '')

@section('sidebar')
    @parent
@stop
@section('active_mis-inscripciones')
    active open
@endsection
@section('avatar')
    {{$usuario->getAvatar()}}
@endsection


@section('Dashboard')

@stop

@section('content')
    <div class="col-md-12">
        <div clas="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div style="background: rgba(32, 32, 36, 0.49);">
                            <div style="color: black; font-size: 26px;">
                                <i class="fa fa-flag" aria-hidden="true" style="margin-left:10px;"></i> <strong> MIS</strong> INSCRIPCIONES
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-7">
                                <h4>Desde este panel podra cambiar preferencia de inscripcion , informar pagos y visualizar el estado de los mismos.</h4>
                            </div>
                            <div class="col-md-5">
                                <a class="btn btn-block btn-social btn-google" style="margin-top:2.5%;">
                                    <i class="fa fa-university" aria-hidden="true"></i> Ver datos para realizar transferencia o deposito
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="width: 96%;margin: 0% 0% 0% 2%;">
                        <div class="row">
                            <div class="box">
                                <div class="box-body" style="padding: -5% 0 0 -5%;">
                                    <div id="tablainscripciones_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                        <div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row">
                                            <div class="col-sm-12">
                                                <table id="tablainscripciones" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                                    <thead>
                                                        <tr role="row" style ="background: #424242;color: white;">
                                                            <th class="sorting_asc" tabindex="0" aria-controls="tablainscripciones" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                                               Competencia
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="tablainscripciones" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                                                Fecha
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="tablainscripciones" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                                                Distancia
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="tablainscripciones" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                                                Categoria
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="tablainscripciones" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                                Valor
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="tablainscripciones" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                                                Estado
                                                            </th>

                                                            <th  tabindex="0"  style="width: 25%;">
                                                                Opciones
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($Inscripciones as $inscripcion)
                                                            <tr role="row" class="odd">
                                                                <td>{{$inscripcion->getCompetencia()}}</td>
                                                                <td>{{$inscripcion->getFecha()}}</td>
                                                                <td>{{$inscripcion->getDistancia()}}</td>
                                                                <td>{{$inscripcion->getCategoria()}}</td>
                                                                <td>{{$inscripcion->getValor()}}</td>
                                                                <td>{{$inscripcion->getEstado()}}</td>
                                                                <td >
                                                                    <div class="col-md-7">
                                                                        <button type="button" class="btn btn-block btn-default btn-sm">Informar pago</button>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <i class="fa fa-list-alt fa-2x" aria-hidden="true"></i><i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
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

