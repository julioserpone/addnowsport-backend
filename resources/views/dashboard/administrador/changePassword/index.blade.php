@extends('layouts.admin.master')
@section('active_password')
    active open
@endsection

@section('title', 'Panel de Administraciòn')

@section('dashboard')
@stop

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Visitors Report</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <div class="box-body no-padding">
            <div class="row">
                <div class="col-md-9 col-sm-8">

                </div>
                <div class="col-md-3 col-sm-4">
                    <div class="pad box-pane-right bg-green" style="min-height: 280px">
                        <div class="description-block margin-bottom">
                            <div class="sparkbar pad" data-color="#fff"><canvas width="34" height="30" style="display: inline-block; width: 34px; height: 30px; vertical-align: top;"></canvas></div>
                            <h5 class="description-header">8390</h5>
                            <span class="description-text">Visits</span>
                        </div>
                        <!-- /.description-block -->
                        <div class="description-block margin-bottom">
                            <div class="sparkbar pad" data-color="#fff"><canvas width="34" height="30" style="display: inline-block; width: 34px; height: 30px; vertical-align: top;"></canvas></div>
                            <h5 class="description-header">30%</h5>
                            <span class="description-text">Referrals</span>
                        </div>
                        <!-- /.description-block -->
                        <div class="description-block">
                            <div class="sparkbar pad" data-color="#fff"><canvas width="34" height="30" style="display: inline-block; width: 34px; height: 30px; vertical-align: top;"></canvas></div>
                            <h5 class="description-header">70%</h5>
                            <span class="description-text">Organic</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                </div>

            </div>

        </div>

    </div>
@stop

