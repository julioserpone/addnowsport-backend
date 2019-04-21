@extends('layouts.admin.master')
@section('active-codigo')
    active open
@endsection

@section('title', 'Panel de Administraciòn')

@section('run-scripts')

    <script>
        jQuery(document).ready(function() {
            Main.init();
        });
    </script>
@endsection

@section('content')
<div class="container-fluid container-fullw ng-scope">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <h5 class="over-title margin-bottom-15">
                        <i class="fa fa-tags" aria-hidden="true"></i>&nbsp;
                        <span class="text-bold">{{ trans('codigos.codigos') }}</span>{{ trans('codigos.de_descuentos') }}</h5>
                    <p>
                        {{ trans('codigos.subtitulo') }}
                    </p>
                    <div class="alert alert-info">
                        Please try to re-size your browser window in order to see the tables in responsive mode.
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="codigos">
                            <thead>
                                <tr>
                                    <th>Domain</th>
                                    <th>Price</th>
                                    <th>Clicks</th>
                                    <th><i class="fa fa-time"></i> Update </th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="#"> alpha.com </a></td>
                                    <td>$45</td>
                                    <td>3,330</td>
                                    <td>February 13</td>
                                    <td><span class="label label-sm label-warning">Expiring</span></td>
                                </tr>
                                <tr>
                                    <td><a href="#"> beta.com </a></td>
                                    <td>$70</td>
                                    <td>3,330</td>
                                    <td>January 15</td>
                                    <td><span class="label label-sm label-success">Registered</span></td>
                                </tr>
                                <tr>
                                    <td><a href="#"> gamma.com </a></td>
                                    <td>$25</td>
                                    <td>3,330</td>
                                    <td>March 09</td>
                                    <td><span class="label label-sm label-danger">Expired</span></td>
                                </tr>
                                <tr>
                                    <td><a href="#"> delta.com </a></td>
                                    <td>$50</td>
                                    <td>3,330</td>
                                    <td>February 10</td>
                                    <td><span class="label label-sm label-inverse">Flagged</span></td>
                                </tr>
                                <tr>
                                    <td><a href="#"> epsilon.com </a></td>
                                    <td>$35</td>
                                    <td>3,330</td>
                                    <td>February 18</td>
                                    <td><span class="label label-sm label-success">Registered</span></td>
                                </tr>
                                <tr>
                                    <td><a href="#"> zeta.com </a></td>
                                    <td>$45</td>
                                    <td>3,330</td>
                                    <td>February 13</td>
                                    <td><span class="label label-sm label-warning">Expiring</span></td>
                                </tr>
                                <tr>
                                    <td><a href="#"> eta.com </a></td>
                                    <td>$70</td>
                                    <td>3,330</td>
                                    <td>January 15</td>
                                    <td><span class="label label-sm label-success">Registered</span></td>
                                </tr>
                                <tr>
                                    <td><a href="#"> theta.com </a></td>
                                    <td>$25</td>
                                    <td>3,330</td>
                                    <td>March 09</td>
                                    <td><span class="label label-sm label-danger">Expired</span></td>
                                </tr>
                                <tr>
                                    <td><a href="#"> iota.com </a></td>
                                    <td>$50</td>
                                    <td>3,330</td>
                                    <td>February 10</td>
                                    <td><span class="label label-sm label-inverse">Flagged</span></td>
                                </tr>
                                <tr>
                                    <td><a href="#"> kappa.com </a></td>
                                    <td>$35</td>
                                    <td>3,330</td>
                                    <td>February 18</td>
                                    <td><span class="label label-sm label-success">Registered</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div >
        <div class="col-md-3">
            <div class="row">
                <input type="text" placeholder="Ingrese codigo" class="form-control">
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
                <select class="form-control">
                    <option>Tipo de Codigo</option>
                    <option>option 1</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
                <select class="form-control">
                    <option>Fecha</option>
                    <option>26/11/1993</option>
                </select>

            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
                <select class="form-control">
                    <option>Estado</option>
                </select>
            </div>
        </div>
        <div class="col-md-1">
            <div class="row">
                <button type="button" class="btn btn-block btn-primary">{{ trans('generals.go') }}</button>
            </div>
        </div>
        <div class="col-md-1">
            <div class="row">
                <button type="button" class="btn btn-block btn-danger">{{ trans('generals.eliminar') }}</button>
            </div>
        </div>
    </div>
</div>

                                    
<div class="row">
    <div class="col-sm-12">
    <table id="sample" class="table table-bordered table-hover dataTable" role="grid">
            <thead>
                <tr role="row">
                    <th>{{ trans('codigos.codigo') }}</th>
                    <th>{{ trans('codigos.tipo') }}</th>
                    <th>{{ trans('codigos.valor') }}</th>
                    <th>{{ trans('generals.creado') }}</th>
                    <th>{{ trans('codigos.vencimiento') }}</th>
                    <th>{{ trans('codigos.competencia') }}</th>
                    <th>{{ trans('codigos.usos') }}</th>
                    <th>{{ trans('generals.estado') }}</th>
                    <th>{{ trans('codigos.detalle') }}</th>
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
                        <input type="checkbox" class="js-switch red" checked />
                    </td>
                    <td>
                        <i class="fa fa-list-alt fa-2x" aria-hidden="true"></i> <i class="fa fa-times-circle-o fa-2x" aria-hidden="true">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
     
        <script>
            $(function () {
                $('#codigos').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true
                });
            });
        </script>
        <style>

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