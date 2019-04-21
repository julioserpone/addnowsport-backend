<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                @if (Auth::check())
                    @if(Auth::getUser()->hasRole(['usuario']))
                        <img src="{{ asset(Auth::getUser()->getAvatar()) }}"
                             class="user-image" alt="avatar"/>
                    @elseif(Auth::getUser()->hasRole(['productora']))
                        <img src="{{ asset(Auth::getUser()->getAvatarProductora()) }}"
                             class="user-image" alt="avatar"/>
                    @endif
                @endif
            </div>
            <div class="pull-left info">
                <a><i class="fa fa-circle text-success"></i></a>
            </div>
        </div>
        <ul class="sidebar-menu">
                @include('layouts.admin.opciones')
        </ul>
    </section>
</aside>