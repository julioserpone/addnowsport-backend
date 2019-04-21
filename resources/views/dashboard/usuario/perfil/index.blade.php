@extends('layouts.admin.master')

{{--
Funciones a utilizar del modelo Usuario
    getAvatar()
    getNombre()
    getApellido()
    getCorreo()
    getDiaFechaNacimiento()
    getMesFechaNacimiento()
    getYearFechaNacimiento()
    getPais()
    getPrefijo()
    getTelefono()
    getGrupo()
    getNombreContacto()
    getPrefijoContacto()
    getTelefonoContacto()
    getDerivacionContacto()
--}}

@section('title', '')
@section('active_perfil')
    active open
@endsection

@section('modal-footer')
    {!! Html::script('js/usuario/main.js') !!}
    {!! Html::script('js/jquery-upload-file/js/jquery.uploadfile.min.js') !!}
    {!! Html::style('js/jquery-upload-file/css/uploadfile.css') !!}

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="updateProfile()">{!! trans('generals.save') !!}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#myModal').modal('hide');">{!! trans('generals.cancel') !!}</button>
    </div>
@endsection

@section('modal-body')
    {{--!! Form::open(array('route' => 'cliente/add', 'method' => 'POST')) !!--}}
    <div class="col-md-12">
        <div clas="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div style="background: rgba(32, 32, 36, 0.49);">
                            <div style="color: black; font-size: 26px;">
                                <i class="fa fa-user" aria-hidden="true" style="margin-left:10px;"> </i>  Datos Personales
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">

                        <div class="box box-profile">
                            <div class="box-body box-profile">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="profile-user-img img-responsive img-rounded" src="{{ asset(e($usuario->getAvatar())) }}">
                                        <input type="file" id="file-select"/>
                                        <button>Cargar</button>
                                        <progress id="prog" value="0" min="0" max="100"></progress>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="input-group" style="margin-top: 10px;">
                                            <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
                                            <input type="text" class="form-control" placeholder="{{trans('generals.name')}}" value="{{e($usuario->getNombre())}}" name="nombre-modal" id="nombre-modal">
                                        </div>

                                        <div class="input-group" style="margin-top: 10px;">
                                            <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
                                            <input type="text" class="form-control" placeholder="{{trans('generals.lastName')}}" value="{{e($usuario->getApellido())}}" name="apellido-modal" id="apellido-modal">
                                        </div>

                                        <div class="input-group" style="margin-top: 10px;">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input type="email" class="form-control" placeholder="{{trans('generals.email')}}" value="{{e($usuario->getCorreo())}}" name="correo-modal" id="correo-modal">
                                        </div>

                                        <div class="row"  style="margin-top: 10px;">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="dia-modal"  id="dia-modal">
                                                        <option>Dia</option>
                                                        <option  selected="selected"> {{e($usuario->getDiaFechaNacimiento())}}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="mes-modal" id="mes-modal">
                                                        <option>Mes</option>
                                                        <option selected="selected"> {{e($usuario->getMesFechaNacimiento())}}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="year-modal" id="year-modal">
                                                        <option>Año</option>
                                                        <option selected="selected"> {{e($usuario->getYearFechaNacimiento())}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($perfil != null)
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::select('pais', trans('pais'), trans('pais.' . e($perfil->getPais())), ['class' => 'form-control select2 select2-hidden-accessible' ,'style' => "width: 100%;", 'tabindex' => "-1", 'aria-hidden' => "true",  'name' => "pais-modal", 'id' => "pais-modal" ]) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="col-md-4">
                                                {!! Form::select('prefijo', trans('prefijo'), trans('prefijo.' . e($perfil->getPrefijo())), ['class' => 'form-control select2 select2-hidden-accessible' ,'style' => "width: 100%;", 'tabindex' => "-1", 'aria-hidden' => "true",  'name' => "prefijo-modal", 'id' => "prefijo-modal" ]) !!}
                                            </div>

                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="{{trans('generals.phone')}}"  value="{{e($perfil->getTelefono())}}" name="telefono-modal" id="telefono-modal">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::select('provincia', trans('provincia'), trans('provincia.' . e($perfil->getProvincia())), ['class' => 'form-control select2 select2-hidden-accessible' ,'style' => "width: 100%;", 'tabindex' => "-1", 'aria-hidden' => "true",  'name' => "provincia-modal", 'id' => "provincia-modal" ]) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                <input type="text" class="form-control" placeholder="{{trans('generals.team')}}" value="{{e($perfil->getGrupo())}}" name="grupo-modal" id="grupo-modal">
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::select('pais', trans('pais'), 0, ['class' => 'form-control select2 select2-hidden-accessible' ,'style' => "width: 100%;", 'tabindex' => "-1", 'aria-hidden' => "true",  'name' => "pais-modal", 'id' => "pais-modal" ]) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="col-md-4">
                                                {!! Form::select('prefijo', trans('prefijo'), 0, ['class' => 'form-control select2 select2-hidden-accessible' ,'style' => "width: 100%;", 'tabindex' => "-1", 'aria-hidden' => "true",  'name' => "prefijo-modal", 'id' => "prefijo-modal" ]) !!}
                                            </div>

                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="{{trans('generals.phone')}}"  value="" name="telefono-modal" id="telefono-modal">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::select('provincia', trans('provincia'), 0, ['class' => 'form-control select2 select2-hidden-accessible' ,'style' => "width: 100%;", 'tabindex' => "-1", 'aria-hidden' => "true",  'name' => "provincia-modal", 'id' => "provincia-modal" ]) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                <input type="text" class="form-control" placeholder="{{trans('generals.team')}}" value="" name="grupo-modal" id="grupo-modal">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div style="background: rgba(32, 32, 36, 0.49);">
                            <div style="color: black; font-size: 26px;">
                                <strong style="margin-left:10px;"><b>CONTACTO</b></strong>  caso de emergencia
                            </div>
                        </div>

                        <div class="box box-profile">
                            <div class="box-body box-profile">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
                                            <input type="text" class="form-control" placeholder="{{trans('generals.name')}} y {{trans('generals.lastName')}}" value="{{e($usuario->getNombreContacto())}}" name="nombre-contacto-modal" id="nombre-contacto-modal">
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="col-md-4">
                                            {!! Form::select('prefijo-contacto', trans('prefijo'), trans('prefijo.' . e($usuario->getPrefijoContacto())), ['class' => 'form-control select2 select2-hidden-accessible' ,'style' => "width: 100%;", 'tabindex' => "-1", 'aria-hidden' => "true",  'name' => "prefijo-contacto-modal", 'id' => "prefijo-contacto-modal" ]) !!}
                                        </div>

                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder="{{trans('generals.phone')}}"  value="{{e($usuario->getTelefonoContacto())}}" name="telefono-contacto-modal" id="telefono-contacto-modal">
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-hospital-o"></i></span>
                                            <input type="text" class="form-control" placeholder="{{trans('generals.derivation')}}" value="{{e($usuario->getDerivacionContacto())}}" name="derivacion-modal" id="derivacion-modal">
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
    {{--!! Form::close() !!--}}

@endsection

@section('content')
    @include('layouts.modal')
    <div class="col-md-12">
        <div clas="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div style="background: rgba(32, 32, 36, 0.49);">
                            <div style="color: black; font-size: 26px;">
                                <i class="fa fa-user" aria-hidden="true" style="margin-left:10px;"> </i>  Datos Personales
                            </div>
                        </div>

                        <div class="box box-profile">
                            <div class="box-body box-profile">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="profile-user-img img-responsive img-rounded" src="{{ asset(e($usuario->getAvatar())) }}">
                                    </div>

                                    <div class="col-md-8">
                                        <div class="input-group" style="margin-top: 10px;">
                                            <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
                                            <input type="text" class="form-control" placeholder="{{trans('generals.name')}}" value="{{e($usuario->getNombre())}}"  name="nombre" id="nombre" disabled>
                                        </div>

                                        <div class="input-group" style="margin-top: 10px;">
                                            <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
                                            <input type="text" class="form-control" placeholder="{{trans('generals.lastName')}}" value="{{e($usuario->getApellido())}}"  name="apellido" id="apellido" disabled>
                                        </div>

                                        <div class="input-group" style="margin-top: 10px;">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input type="email" class="form-control" placeholder="{{trans('generals.email')}}" value="{{e($usuario->getCorreo())}}"  name="correo" id="correo" disabled>
                                        </div>


                                        <div class="row"  style="margin-top: 10px;">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="dia"  id="dia" disabled>
                                                        <option>Dia</option>
                                                        <option  selected="selected"> {{e($usuario->getDiaFechaNacimiento())}}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="mes" id="mes"disabled>
                                                        <option>Mes</option>
                                                        <option selected="selected"> {{e($usuario->getMesFechaNacimiento())}}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="year" id="year" disabled>
                                                        <option>Año</option>
                                                        <option selected="selected"> {{e($usuario->getYearFechaNacimiento())}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($perfil != null)
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="{{trans('generals.pais')}}" value="{{trans('pais.' . e($perfil->getPais()))}}" name="pais" id="pais" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" placeholder="{{trans('generals.code')}}"  value="{{e($perfil->getPrefijo())}}" name="prefijo" id="prefijo" disabled>
                                            </div>

                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="{{trans('generals.phone')}}"  value="{{e($perfil->getTelefono())}}" name="telefono" id="telefono" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="{{trans('generals.provincia')}}"  value="{{e($perfil->getProvincia())}}"  name="provincia" id="provincial" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                <input type="text" class="form-control" placeholder="{{trans('generals.team')}}" value="{{e($perfil->getGrupo())}}"  name="grupo" id="grupo" disabled>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="{{trans('generals.pais')}}" value="" name="pais" id="pais" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" placeholder="{{trans('generals.code')}}"  value="" name="prefijo" id="prefijo" disabled>
                                            </div>

                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="{{trans('generals.phone')}}"  value="" name="telefono" id="telefono" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="{{trans('generals.provincia')}}"  value=""  name="provincia" id="provincial" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                <input type="text" class="form-control" placeholder="{{trans('generals.team')}}" value=""  name="grupo" id="grupo" disabled>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div style="background: rgba(32, 32, 36, 0.49);">
                            <div style="color: black; font-size: 26px;">
                                <strong style="margin-left:10px;"><b>CONTACTO</b></strong>  caso de emergencia
                            </div>
                        </div>

                        <div class="box box-profile">
                            <div class="box-body box-profile">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
                                            <input type="text" class="form-control" placeholder="{{trans('generals.name')}} y {{trans('generals.lastName')}}" value="{{e($usuario->getNombreContacto())}}"  name="nombre-contacto" id="nombre-contacto" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" placeholder="{{trans('generals.code')}}"  value="{{trans('prefijo.' . e($usuario->getPrefijoContacto()))}}" name="prefijo-contacto" id="prefijo-contacto" disabled>
                                        </div>

                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder="{{trans('generals.phone')}}"  value="{{e($usuario->getTelefonoContacto())}}" name="telefono-contacto" id="telefono-contacto" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-hospital-o"></i></span>
                                            <input type="text" class="form-control" placeholder="{{trans('generals.derivation')}}" value="{{e($usuario->getDerivacionContacto())}}" name="derivacion" id="derivacion" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pull-right">
                    <button type="button" class="btn btn-lg" data-toggle="modal" data-target="#myModal">{!! trans('generals.editProfile') !!}</button>
                </div>
            </div>
        @include('dashboard.usuario.help-contacto')
        </div>
    </div>
@stop

