
<li class="@yield('active_perfil')">
    <a href="{{route('productora/perfil')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="U" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("productora.datos")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active_datos-bancarios')">
    <a href="{{route('productora/datos-bancarios')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="D B" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("productora.datos_bancarios")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active_pin')">
    <a href="{{route('productora/pin')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="P" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("productora.pin")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active_nueva-competencia')">
    <a href="{{route('productora/competencia_crear')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="N C" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("productora.nueva_competencia")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active_mis-competencias')">
    <a href="{{route('productora/mis-competencias')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="M C" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("productora.mis_competencias")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<liclass="@yield('active_lista-inscriptos')">
    <a href="{{route('productora/lista-inscriptos')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="L I" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("productora.lista_inscriptos")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active_codigo')">
    <a href="{{route('productora/codigo')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="C" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("productora.codigo")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active_cargar-tiempo')">
    <a href="{{route('productora/cargar-tiempo')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="C T" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("productora.cargar_tiempo")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active_generar_categoria')">
    <a href="{{route('productora/generar-categoria')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="G C" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("productora.generar_categoria")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active_tabla-de-puntos')">
    <a href="{{route('productora/tablas-de-puntos')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="T D P" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("productora.tablas_de_puntos")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active_resultados')">
    <a href="{{route('productora/resultados')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="R" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("productora.resultados")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>

<li class="@yield('active_ventas-realizadas')">
    <a href="{{route('productora/ventas-realizadas')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="V R" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("productora.ventas_realizadas")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>>

<li class="@yield('active_retirar-fondos')">
    <a href="{{route('productora/retirar-fondos')}}">
        <div class="item-content">
            <div class="item-media">
                <div class="lettericon" data-text="R F" data-size="sm" data-char-count="2"></div>
            </div>
            <div class="item-inner">
                <span class="title"> {{trans("productora.retirar_fondos")}} </span><i class="icon-arrow"></i>
            </div>
        </div>
    </a>
</li>