<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
          <!-- <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.multilevel') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                </ul>
            </li>-->
            <li><a href="#"><i class='fa fa-cogs'></i> <span>Panel de control</span></a></li>
            <li><a href="#"><i class='glyphicon glyphicon-list'></i> <span>Datos principales</span></a></li>
            <li><a href="#"><i class='glyphicon glyphicon-info-sign'></i> <span>información de competencias</span></a></li>
            <li><a href="#"><i class='glyphicon glyphicon-calendar'></i> <span>Fechas</span></a></li>
            <li><a href="#"><i class='glyphicon glyphicon-star'></i> <span>Premiación</span></a></li>
            <li><a href="#"><i class='glyphicon glyphicon-usd'></i> <span>Valor de inscripción</span></a></li>
            <li><a href="#"><i class='glyphicon glyphicon-align-justify'></i> <span>Reglamentos</span></a></li>
            <li><a href="#"><i class='glyphicon glyphicon-usd'></i> <span>Sponsors</span></a></li>
            <li><a href="#"><i class='fa fa-cloud'></i> <span>WebSite</span></a></li>
            <li><a href="#"><i class='glyphicon glyphicon-usd'></i> <span>Galería de imágenes</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
