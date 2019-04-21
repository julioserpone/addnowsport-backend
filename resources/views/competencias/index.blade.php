@extends('layouts.admin.master')

@section('title', 'Competencia')

@section('sidebar')
    @parent
@stop

@section('Dashboard')

@stop
   
   
   
   
@section('content')
    <div ng-app="app" >
        <!-- Main content -->


        <section class="content" ng-controller="CompentenciasWizardController">
            <div class="row">
<div class="col-md-12">
<div id="ngwizard">
  <div class="navbar">
                          <div class="navbar-inner">
                            <div>
                        <ul class="nav nav-pills">
                           <!-- <li ng-class="{active: wizard.current == 1}"><a data-toggle="tab" href="#tab1" ng-click="(wizard.current = 1)">Datos principales</a></li>
                            <li ng-class="{active: wizard.current == 2}"><a data-toggle="tab" href="#tab2" ng-click="(reloadCK())">Descripción</a></li>
                            <li ng-class="{active: wizard.current == 3}"><a data-toggle="tab" href="#tab3" ng-click="(wizard.current = 3)">Fechas</a></li>
                            <li ng-class="{active: wizard.current == 4}"><a data-toggle="tab" href="#tab4" ng-click="(wizard.refreshMap())">Lugares</a></li>
                            <li ng-class="{active: wizard.current == 5}"><a data-toggle="tab" href="#tab5" ng-click="(wizard.current = 5)">Distancias</a></li>-->

                            <li ng-class="{active: wizard.current == 1}"><a>Datos principales</a></li>
                            <li ng-class="{active: wizard.current == 2}"><a>Descripción</a></li>
                            <li ng-class="{active: wizard.current == 3}"><a>Fechas</a></li>
                            <li ng-class="{active: wizard.current == 4}"><a>Lugares</a></li>
                            <li ng-class="{active: wizard.current == 5}"><a>Distancias</a></li>
                        </ul>
                         </div>
                          </div>
                        </div>
  <div class="tab-content">
  <div id="tab1" class="tab-pane active">
    <div ng-if="(wizard.current == 1)" ng-include="'../views/competencias/competencia_step2.html'"></div>
   </div> 
   <div id="tab2" class="tab-pane active">
    <div ng-show="(wizard.current == 2)" ng-include="'../views/competencias/competencia_step3.html'"></div>
   </div> 
   <div id="tab3" class="tab-pane active">
    <div ng-if="(wizard.current == 3)" ng-include="'../views/competencias/competencia_step4.html'"></div>
   </div> 
   <div id="tab4" class="tab-pane active">
    <div ng-if="(wizard.current == 4)" ng-include="'../views/competencias/competencia_step5.html'"></div>
   </div> 
   <div id="tab4" class="tab-pane active">
    <div ng-if="(wizard.current == 5)" ng-include="'../views/competencias/competencia_step6.html'"></div>
   </div> 

   <ul class="pager wizard">
                                <li class="previous first" ng-show="(wizard.current != 1)"  ng-click="(wizard.current = 1)"><a href="#">Primera</a></li>
                                <li class="previous" ng-show="(wizard.current != 1)" ><a href="#" ng-click="(wizard.back())">Anterior</a></li>
                            
                               <li class="next last"><a href="#" ng-show="(wizard.current < wizard.last)" ng-click="(wizard.current = wizard.last)">Last</a></li>
                              <li class="next"><a href="#" ng-click="(wizard.next())" ng-show="(wizard.current < wizard.last)">Siguiente</a></li>
                                <li class="next finish" ng-show="(wizard.current == wizard.last)"><a href="javascript:;">Guardar</a></li>
                            </ul>

                          <!-- <pre> [[evento | json]] </pre>-->
    </div>  
    </div>     
</div>
</div>
</div>
</div>
@stop

@section('script')
<!-- Angular js -->
<script src="{{ asset('/js/angular.min.js') }}" type="text/javascript"></script>


<script src="{{ asset('/js/addnowNG.js') }}" type="text/javascript"></script>


<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/0.9.2/trix.css">

<script src="//cdnjs.cloudflare.com/ajax/libs/trix/0.9.2/trix.js"></script>

<script src="{{asset('js/angular-trix-master/dist/angular-trix.js')}}"></script>

<script src="{{ asset('/js/ui-bootstrap-tpls-2.1.3.min.js') }}" type="text/javascript"></script>

<!-- Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4Sb7dRixywyL8zQ4ERdROthxRXJcCKP8&libraries=places" type="text/javascript"></script>

<script src="{{asset('js/ngmap/build/scripts/ng-map.js')}}"></script>
@stop