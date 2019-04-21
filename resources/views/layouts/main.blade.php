<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base id="url" href="{{ URL::to('/') }}" />
    <title>PSP:: Es hora de jugar ::</title>

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('font-awesome/css/font-awesome.css') }}
    {{ HTML::style('css/plugins/editable/editable.css') }}
    {{ HTML::style('css/plugins/fancybox/fancybox.css') }}

    {{ HTML::style('css/admin.css') }}

    @section('styles_head')
    @show 

    <script>
        (function(i,s,o,g,r,a,m){
            i['GoogleAnalyticsObject']=r;i[r]=i[r] || function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-51273504-2', 'kairosnowplay.com');
        ga('send', 'pageview');
    </script>    
<!-- main -->
</head>

<body>

    <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Admin</a>
        </div>
        <!-- /.navbar-header -->

        <div class="collapse navbar-collapse" id="main-menu">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('admin') ? 'active' : '' }}">
                    <a href="{{ URL::to('/admin') }}"><i class="fa fa-home fa-fw"></i> Inicio</a>
                </li>
                <li class="{{ Request::is('admin/inscriptos*') ? 'active' : '' }}">
                    <a href="{{ URL::to('/admin/inscriptos') }}"><i class="fa fa-check-square-o fa-fw"></i> Inscritos</a>
                </li>
                <li class="{{ Request::is('admin/teams*') ? 'active' : '' }}">
                    <a href="{{ URL::to('/admin/teams') }}"><i class="fa fa-check-square-o fa-fw"></i> Teams</a>
                </li>                
                <li class="{{ Request::is('admin/resultados*') ? 'active' : '' }}">
                    <a href="{{ URL::to('/admin/resultados') }}"><i class="fa fa-list-ol fa-fw"></i> Resultados</a>
                </li>                
                <li class="{{ Request::is('admin/cupones*') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/cupones') }}"><i class="fa fa-tags fa-fw"></i> Cupones</a>
                </li>                
                <li class="{{ Request::is('admin/distancias*') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/distancias') }}"><i class="fa fa-users fa-fw"></i> Distancias</a>
                </li>
                <li class="{{ Request::is('admin/competencias*') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/competencias') }}"><i class="fa fa-users fa-fw"></i> Competencias</a>
                </li>
                <li class="{{ Request::is('admin/productoras*') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/productoras') }}"><i class="fa fa-building-o fa-fw"></i> Productoras</a>
                </li>
                <li class="{{ Request::is('admin/facturacion*') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/facturacion') }}"><i class="fa fa-dollar fa-fw"></i> Facturación</a>
                </li>
                <li class="hide {{ Request::is('admin/usuarios*') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/usuarios') }}"><i class="fa fa-users fa-fw"></i> Usuarios</a>
                </li>
            </ul>
            <!-- /#side-menu -->

            <ul class="nav navbar-nav navbar-right">
                @if(isset($notices))
                    @include('admin.notifications')
                @endif
                <li class="divider"></li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>
                        {{{ Auth::user()->name }}}
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ URL::to('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Salir</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <li class="divider"></li>
                <!-- /.dropdown -->

            </ul>
        <!-- /.navbar-top-links -->
        </div>
        <!-- /.sidebar-collapse -->
    </nav>
    <!-- /.navbar-static-top -->

    <div id="page-wrapper">
        @yield('content')
    </div>
    <!-- /#page-wrapper -->

    <!-- Core Scripts - Include with every page -->
    {{ HTML::script('js/jquery-1.10.2.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/plugins/editable/editable.js') }}
    {{ HTML::script('js/plugins/notify/notify.min.js') }}
    {{ HTML::script('js/plugins/fancybox/fancybox.js') }}
    {{ HTML::script('js/vendor/bootbox.min.js') }}

    @section('scripts_footer')
    @show 

    {{ HTML::script('js/app/admin.js') }}    

</body>

</html>
