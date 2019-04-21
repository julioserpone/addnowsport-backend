<li class="@yield('active_perfil')">
    <a href="{{route('usuario/perfil')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="D P" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("usuario.datos")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active_password')">
    <a href="{{route('usuario/changePassword')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="C C" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("usuario.cambiar_clave")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active_mis-inscripciones')">
    <a href="{{route('usuario/misinscripciones')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="M I" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("usuario.inscripciones")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active_mis-resultados')">
    <a href="">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="E R" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("usuario.exportar_resultados")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active_codigo')">
    <a href="">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="C" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("usuario.credito")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active_favoritos')">
    <a href="">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="F" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("usuario.favoritos")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>
