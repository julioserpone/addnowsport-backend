<li  class="@yield('active_perfil')">
    <a href="{{route('soporte/perfil')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="U" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("soporte.datos")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li  class="@yield('active_password')">
    <a href="{{route('soporte/changePassword')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="U" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("soporte.cambiar_clave")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>