<div class="sidebar app-aside" id="sidebar">
    <div class="sidebar-container perfect-scrollbar">
        <div>
            <!-- start: USER OPTIONS -->
            <div class="nav-user-wrapper">
                <div class="media">
                    @if (Auth::check())
                    <div class="media-left">
                        <a class="profile-card-photo" href="#">
                            @if(Auth::getUser()->hasRole(['productora']))
                            {!! Html::image(asset(Auth::getUser()->getAvatarProductora()), 
                            'avatar') !!}
                            @else
                            {!! Html::image(asset(Auth::getUser()->getAvatar()), 
                            'avatar') !!}
                            @endif
                        </a>
                    </div>
                    <div class="media-body">
                        <span class="media-heading text-white">
                            {!! Auth::getUser()->getNombre()  !!}
                        </span>
                        <div class="text-small text-white-transparent">
                            {!! Auth::getUser()->getApellido()  !!}
                        </div>
                    </div>
                    <div class="media-right media-middle">
                        <div class="dropdown">
                            <button href class="btn btn-transparent text-white 
                                    dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu animated fadeInRight pull-right">
                                <li>
                                    {!! HTML::link('/', 'Perfil') !!}
                                </li>
                                <li class="divider"></li>
                                <li>
                                    {!! HTML::link(route('logout'), 'Salir') !!}
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <!-- end: USER OPTIONS -->
            <nav>
                <!-- start: MAIN NAVIGATION MENU -->
                <div class="navbar-title">
                    <span>Menú Principal</span>
                </div>
                <ul class="main-navigation-menu">
                    @if(Auth::getUser()->hasRole(['administrador']))
                        @include('layouts.admin.opciones.administrador')
                    @elseif(Auth::getUser()->hasRole(['productora']))
                        @include('layouts.admin.opciones.productora')
                    @elseif(Auth::getUser()->hasRole(['soporte']))
                        @include('layouts.admin.opciones.soporte')
                    @elseif(Auth::getUser()->hasRole(['usuario']))
                        @include('layouts.admin.opciones.usuario')
                    @endif
                </ul>
                <!-- end: MAIN NAVIGATION MENU -->
            </nav>
        </div>
    </div>
</div>