<header id="header" data-plugin-options='{"stickyEnabled": true, 
        "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, 
        "stickyStartAt": 57, "stickySetTop": "-57px", "stickyChangeLogo": true}'>
    <div class="header-body">
        <div class="header-container container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-logo">
                        {!! Html::link(route('home'), 'PSP - Play Social Pass', 
                        ['class'=>'navbar-brand']) !!}
                    </div>
                </div>
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-search hidden-xs">
                            {!! Form::open(['url' => '/', 'class' => 'form',
                            'role' => 'form', 'id' => 'searchForm', 'method'=> 'get']) !!}
                            <div class="input-group">
                                {!! Form::text('busqueda', '', 
                                ['class' => 'form-control input-lg',
                                'autocomplete' => 'off', 'required' => true,
                                'placeholder' => 'Buscar']) !!}
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <nav class="header-nav-top">
                            <ul class="nav nav-pills">
                                <li class="hidden-xs">
                                    <a href="#">
                                        <i class="fa fa-angle-right"></i>
                                        Nosotros
                                    </a>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#">
                                        <i class="fa fa-angle-right"></i>
                                        Contacto
                                    </a>
                                </li>
                                <li>
                                    <span class="ws-nowrap"><i class="fa fa-phone"></i>
                                        +54 (115) 0314713 / Int 822
                                    </span>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="header-row">
                        <div class="header-nav">
                            <button class="btn header-btn-collapse-nav" d
                                    ata-toggle="collapse" data-target=".header-nav-main">
                                <i class="fa fa-bars"></i>
                            </button>
                            <ul class="header-social-icons social-icons hidden-xs">
                                <li class="social-icons-facebook">
                                    <a href="http://www.facebook.com/" target="_blank" title="Facebook">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="social-icons-twitter">
                                    <a href="http://www.twitter.com/" target="_blank" title="Twitter">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="social-icons-linkedin">
                                    <a href="http://www.linkedin.com/" target="_blank" title="Linkedin">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="header-nav-main header-nav-main-effect-1 
                                 header-nav-main-sub-effect-1 collapse">
                                <nav>
                                    <ul class="nav nav-pills" id="mainNav">
                                        @if (!Auth::check())
                                        <li class="dropdown">
                                            <a  href="{!! url('register') !!}">
                                                <i class="fa fa-user-plus"></i>
                                                Registro
                                            </a>
                                        </li>
                                        <li class="dropdown">
                                            <a  href="{!! url('login') !!}">
                                                <i class="fa fa-user"></i>
                                                Iniciar Sesión
                                            </a>
                                        </li>
                                        @else
                                            @if(!\Auth::user()->activado)
                                            <li class="dropdown">
                                                <a href="{{ url('reactivate') }}">
                                                    <i class="fa fa-bell"></i>
                                                    Reenviar Correo de Verificación
                                                </a>
                                            </li>
                                            @endif
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" href="{!! url('/') !!}">
                                                    <i class="fa fa-user"></i>
                                                    {!! Auth::user()->email !!}
                                                </a>
                                                <ul class="dropdown-menu">
                                                    {{-- @if(App\Modelos\Usuario::puedeAcceder('ver.administracion')) --}}
                                                    <li>
                                                        <a href="{!! url('administrador') !!}">
                                                            <i class="fa fa-table"></i>
                                                            Administrar
                                                        </a>
                                                    </li>
                                                    <li role="separator" class="divider" 
                                                        style="width: 100% !important;">
                                                    </li>
                                                    {{-- @endif --}}
                                                    <li>
                                                        <a href="{!! url('logout') !!}">
                                                            <i class="fa fa-sign-out"></i>
                                                            Salir
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

