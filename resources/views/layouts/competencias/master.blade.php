<!DOCTYPE html>	
<html>
    <head>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <title>PSP - @yield('title')</title>

        <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/adminlte/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/adminlte/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('/adminlte/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
        
    <script src="{{ asset('/adminlte/plugins/jQuery/jQuery-2.1.4.min.js') }}" type="text/javascript"></script>
   <link href="{{ asset('/js/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
    
   </head>

    <body class="skin-red-light">
        <div class="wrapper">
            @include('layouts.competencias.header')
            @include('layouts.competencias.sidebar')

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        @yield('Dashboard')
                    </h1>
                </section>

                <section class="content">
                    @yield('content')
                </section>
            </div>
        </div>

        @include('layouts.competencias.footer')

        <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/adminlte/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/adminlte/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/adminlte/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/adminlte/js/app.js') }}" type="text/javascript"></script>



        <!-- REQUIRED JS SCRIPTS -->



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

    </body>
</html>