{!! Html::script('js/changePassword.js') !!}
<div class="col-md-12">
    <div clas="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div style="background: rgba(32, 32, 36, 0.49);">
                        <div style="color: black; font-size: 26px;">
                            <i class="fa fa-user" aria-hidden="true" style="margin-left:10px;"> </i>  {{trans('generals.change_password') }}
                        </div>
                    </div>

                    <div class="box box-profile">
                        <div class="box-body box-profile">
                            <div class="row">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">

                                <div class="col-md-8">
                                    <div class="input-group" style="margin-top: 10px;">
                                        <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
                                        <input type="password" class="form-control" placeholder="{{trans('generals.old_password')}}"  name="old_password" id="old_password">
                                    </div>

                                    <div class="input-group" style="margin-top: 10px;">
                                        <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
                                        <input type="password" class="form-control" placeholder="{{trans('generals.new_password')}}"  name="new_password" id="new_password">
                                    </div>

                                    <div class="input-group" style="margin-top: 10px;">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="password" class="form-control" placeholder="{{trans('generals.repeat_password')}}"  name="same_password" id="same_password">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pull-right">
                <button type="button" class="btn btn-lg" data-toggle="modal" onclick="changePassword()">{!! trans('generals.save_changes') !!}</button>
            </div>
        </div>
        @yield('side-menu')
    </div>
</div>