<li class="@yield('active-panel')">
    <a href="{{route('administrador/panel')}}">
        <div class="item-content">
            <div class="item-media">
                <i class="fa fa-bar-chart-o" aria-hidden="true" 
                   style="color: #000 !important"></i>
            </div>
            <div class="item-inner">
                <span class="title">{{trans("administrador.panel")}}</span>
                <i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active-usuarios')">
    <a href="{{route('administrador/usuarios')}}">
        <div class="item-content">
            <div class="item-media">
                <i class="fa fa-users" aria-hidden="true" 
                   style="color: #000 !important"></i>
            </div>
            <div class="item-inner">
                <span class="title">{{trans("administrador.usuarios")}}</span>
                <i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active-productoras')">
    <a href="{{route('administrador/productoras')}}">
        <div class="item-content">
            <div class="item-media">
                <i class="fa fa-user-secret" aria-hidden="true" 
                   style="color: #000 !important"></i>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("administrador.productora")}}</span>
                <i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>


<li class="@yield('active-ventas')">
    <a href="{{route('administrador/ventas')}}">
        <div class="item-content">
            <div class="item-media">
                <i class="fa fa-folder" aria-hidden="true" 
                   style="color: #000 !important"></i>
            </div>
            <div class="item-inner">
                <span class="title">{{trans("administrador.ventas")}}</span>
                <i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active-transferir')">
    <a href="{{route('administrador/transferir')}}">
        <div class="item-content">
            <div class="item-media">
                <i class="fa fa-money" aria-hidden="true" 
                   style="color: #000 !important"></i>
            </div>
            <div class="item-inner">
                <span class="title">{{trans("administrador.transferir")}}</span>
                <i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active-balance')">
    <a href="{{route('administrador/balance')}}">
        <div class="item-content">
            <div class="item-media">
                <i class="fa fa-pie-chart" aria-hidden="true" 
                   style="color: #000 !important"></i>
            </div>
            <div class="item-inner">
                <span class="title">{{trans("administrador.balance")}}</span>
                <i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active-inscriptos')">
    <a href="{{route('administrador/inscriptos')}}">
        <div class="item-content">
            <div class="item-media">
                <i class="fa fa-navicon" aria-hidden="true" 
                   style="color: #000 !important"></i>
            </div>
            <div class="item-inner">
                <span class="title">{{trans("administrador.lista_inscriptos")}}</span>
                <i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active-codigo')">
    <a href="{{route('administrar.codigos')}}">
        <div class="item-content">
            <div class="item-media">
                <i class="fa fa-tags" aria-hidden="true" 
                   style="color: #000 !important"></i>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("administrador.codigo")}}</span>
                <i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active-mailing')">
    <a href="{{route('administrador/mailing')}}">
        <div class="item-content">
            <div class="item-media">
                <i class="fa fa-envelope" aria-hidden="true" 
                   style="color: #000 !important"></i>
            </div>
            <div class="item-inner">
                <span class="title">{{trans("administrador.mailing")}}</span>
                <i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active-asistente')">
    <a href="{{route('administrador/asistente')}}">
        <div class="item-content">
            <div class="item-media">
                <i class="fa fa-heartbeat" aria-hidden="true" 
                   style="color: #000 !important"></i>
            </div>
            <div class="item-inner">
                <span class="title">{{trans("administrador.asistente")}}</span>
                <i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active-index')">
    <a href="{{route('chat')}}">
        <div class="item-content">
            <div class="item-media">
                <i class="fa fa-comments" aria-hidden="true" 
                   style="color: #000 !important"></i>
            </div>
            <div class="item-inner">
                <span class="title">{{trans("administrador.mensaje")}}</span>
                <i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active-index')">
    <a href="{{route('administrador/index')}}">
        <div class="item-content">
            <div class="item-media">
                <i class="fa fa-calculator" aria-hidden="true" 
                   style="color: #000 !important"></i>
            </div>
            <div class="item-inner">
                <span class="title">{{trans("administrador.index")}}</span>
                <i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>