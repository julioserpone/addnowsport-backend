<!-- start: TOP NAVBAR -->
<header class="navbar navbar-default navbar-static-top">
    <!-- start: NAVBAR HEADER -->
    <div class="navbar-header">
        <button href="#" class="sidebar-mobile-toggler pull-left btn no-radius hidden-md hidden-lg" class="btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
            <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="index.html"> <img src="{{asset('assets/packet/images/logo.png')}}" alt="Packet"/> </a>
        <a class="navbar-brand navbar-brand-collapsed" href="index.html"> <img src="{{asset('assets/packet/images/logo-collapsed.png')}}" alt="" /> </a>

        <button class="btn pull-right menu-toggler visible-xs-block" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse" data-toggle-class="menu-open">
            <i class="fa fa-folder closed-icon"></i><i class="fa fa-folder-open open-icon"></i><small><i class="fa fa-caret-down margin-left-5"></i></small>
        </button>
    </div>
    <!-- end: NAVBAR HEADER -->
    <!-- start: NAVBAR COLLAPSE -->
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-left hidden-sm hidden-xs">
            <li class="sidebar-toggler-wrapper">
                <div>
                    <button href="javascript:void(0)" class="btn sidebar-toggler visible-md visible-lg">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
            </li>
            <li>
                <a href="#" class="toggle-fullscreen"> <i class="fa fa-expand expand-off"></i><i class="fa fa-compress expand-on"></i></a>
            </li>
            <li class="hidden-md">
                <form role="search" class="navbar-form main-search">
                    <div class="form-group">
                        <input type="text" placeholder="Enter search text here..." class="form-control">
                        <button class="btn search-button" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </li>
        </ul>
        <ul class="nav navbar-right">
            <!-- start: HOME DROPDOWN -->
            <li class="dropdown">
                <a href class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-home"></i> </a>
                <ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large animated fadeInUpShort">
                    <li>
                        <span class="dropdown-header"> Unread messages</span>
                    </li>
                    <li>
                        <div class="drop-down-wrapper ps-container">
                            <ul>
                                <li class="unread">
                                    <a href="javascript:;" class="unread">
                                        <div class="clearfix">
                                            <div class="thread-image">
                                                <img src="{{asset('assets/packet/images/avatar-2.jpg')}}" alt="">
                                            </div>
                                            <div class="thread-content">
                                                <span class="author">Nicole Bell</span>
                                                <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                <span class="time"> Just Now</span>
                                            </div>
                                        </div> </a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="unread">
                                        <div class="clearfix">
                                            <div class="thread-image">
                                                <img src="{{asset('assets/packet/images/avatar-3.jpg')}}" alt="">
                                            </div>
                                            <div class="thread-content">
                                                <span class="author">Steven Thompson</span>
                                                <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                <span class="time">8 hrs</span>
                                            </div>
                                        </div> </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <div class="clearfix">
                                            <div class="thread-image">
                                                <img src="{{asset('assets/packet/images/avatar-5.jpg')}}" alt="">
                                            </div>
                                            <div class="thread-content">
                                                <span class="author">Kenneth Ross</span>
                                                <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                <span class="time">14 hrs</span>
                                            </div>
                                        </div> </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="view-all">
                        <a href="#"> See All </a>
                    </li>
                </ul>
            </li>
            <!-- end: HOME DROPDOWN -->

            <!-- start: CALENDAR DROPDOWN -->
            <li class="dropdown">
                <a href class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-calendar"></i> </a>
                <ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large animated fadeInUpShort">
                    <li>
                        <div class="drop-down-wrapper ps-container">
                            <ul>
                                <li class="unread">
                                    <a href="javascript:;" class="unread">
                                        <div class="clearfix">
                                            <div class="thread-image">
                                                <img src="{{asset('assets/packet/images/avatar-2.jpg')}}" alt="">
                                            </div>
                                            <div class="thread-content">
                                                <span class="author">Nicole Bell</span>
                                                <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                <span class="time"> Just Now</span>
                                            </div>
                                        </div> </a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="unread">
                                        <div class="clearfix">
                                            <div class="thread-image">
                                                <img src="{{asset('assets/packet/images/avatar-3.jpg')}}" alt="">
                                            </div>
                                            <div class="thread-content">
                                                <span class="author">Steven Thompson</span>
                                                <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                <span class="time">8 hrs</span>
                                            </div>
                                        </div> </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <div class="clearfix">
                                            <div class="thread-image">
                                                <img src="{{asset('assets/packet/images/avatar-5.jpg')}}" alt="">
                                            </div>
                                            <div class="thread-content">
                                                <span class="author">Kenneth Ross</span>
                                                <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                <span class="time">14 hrs</span>
                                            </div>
                                        </div> </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="view-all">
                        <a href="#"> See All </a>
                    </li>
                </ul>
            </li>
            <!-- end: CALENDAR DROPDOWN -->

            <!-- start: STAR DROPDOWN -->
            <li class="dropdown">
                <a href class="dropdown-toggle" data-toggle="dropdown"></span> <i class="fa fa-star"></i> </a>
                <ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large animated fadeInUpShort">
                    <li>
                        <div class="drop-down-wrapper ps-container">
                            <ul>
                                <li class="unread">
                                    <a href="javascript:;" class="unread">
                                        <div class="clearfix">
                                            <div class="thread-image">
                                                <img src="{{asset('assets/packet/images/avatar-2.jpg')}}" alt="">
                                            </div>
                                            <div class="thread-content">
                                                <span class="author">Nicole Bell</span>
                                                <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                <span class="time"> Just Now</span>
                                            </div>
                                        </div> </a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="unread">
                                        <div class="clearfix">
                                            <div class="thread-image">
                                                <img src="{{asset('assets/packet/images/avatar-3.jpg')}}" alt="">
                                            </div>
                                            <div class="thread-content">
                                                <span class="author">Steven Thompson</span>
                                                <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                <span class="time">8 hrs</span>
                                            </div>
                                        </div> </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <div class="clearfix">
                                            <div class="thread-image">
                                                <img src="{{asset('assets/packet/images/avatar-5.jpg')}}" alt="">
                                            </div>
                                            <div class="thread-content">
                                                <span class="author">Kenneth Ross</span>
                                                <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                <span class="time">14 hrs</span>
                                            </div>
                                        </div> </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="view-all">
                        <a href="#"> See All </a>
                    </li>
                </ul>
            </li>
            <!-- end: STAR DROPDOWN -->

            <!-- start: FLAG DROPDOWN -->
            <li class="dropdown">
                <a href class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag"></i> </a>
                <ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large animated fadeInUpShort">

                    <li>
                        <div class="drop-down-wrapper ps-container">
                            <ul>
                                <li class="unread">
                                    <a href="javascript:;" class="unread">
                                        <div class="clearfix">
                                            <div class="thread-image">
                                                <img src="{{asset('assets/packet/images/avatar-2.jpg')}}" alt="">
                                            </div>
                                            <div class="thread-content">
                                                <span class="author">Nicole Bell</span>
                                                <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                <span class="time"> Just Now</span>
                                            </div>
                                        </div> </a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="unread">
                                        <div class="clearfix">
                                            <div class="thread-image">
                                                <img src="{{asset('assets/packet/images/avatar-3.jpg')}}" alt="">
                                            </div>
                                            <div class="thread-content">
                                                <span class="author">Steven Thompson</span>
                                                <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                <span class="time">8 hrs</span>
                                            </div>
                                        </div> </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <div class="clearfix">
                                            <div class="thread-image">
                                                <img src="{{asset('assets/packet/images/avatar-5.jpg')}}" alt="">
                                            </div>
                                            <div class="thread-content">
                                                <span class="author">Kenneth Ross</span>
                                                <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                <span class="time">14 hrs</span>
                                            </div>
                                        </div> </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="view-all">
                        <a href="#"> See All </a>
                    </li>
                </ul>
            </li>
            <!-- end: FLAG DROPDOWN -->

            <!-- start: BELL DROPDOWN -->
            <li class="dropdown">
                <a href class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell"></i> </a>
                <ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large animated fadeInUpShort">
                    <li>
                        <span class="dropdown-header"> You have new notifications</span>
                    </li>
                    <li>
                        <div class="drop-down-wrapper ps-container">
                            <div class="list-group no-margin">
                                <a class="media list-group-item" href=""> <img class="img-circle" alt="..." src="{{asset('assets/packet/images/avatar-1.jpg')}}"> <span class="media-body block no-margin"> Use awesome animate.css <small class="block text-grey">10 minutes ago</small> </span> </a>
                                <a class="media list-group-item" href=""> <span class="media-body block no-margin"> 1.0 initial released <small class="block text-grey">1 hour ago</small> </span> </a>
                            </div>
                        </div>
                    </li>
                    <li class="view-all">
                        <a href="#"> See All </a>
                    </li>
                </ul>
            </li>
            <!-- end: BELL DROPDOWN -->

            <!-- start: MESSAGES DROPDOWN -->
            <li class="dropdown">
                <a href class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> </a>
                <ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large animated fadeInUpShort">
                    @if (Auth::check())
                        @if(Auth::getUser()->hasRole(['usuario']))
                            <li>
                                <div class="drop-down-wrapper ps-container">
                                    <ul>
                                        @foreach(Auth::getUser()->getPerfilesProductora() as $lista)
                                            <li class="unread">
                                                <a href="javascript:;" class="unread">
                                                    <div class="clearfix">
                                                        <div class="thread-image">
                                                            <img class="img-circle" width="40" src="{{ asset($lista->getAvatar()) }}" alt="avatar"/>
                                                        </div>
                                                        <div class="thread-content">
                                                            {!! Form::open(array('route' => 'productora', 'method' => 'POST')) !!}
                                                            {!! Form::hidden('rut', e($lista->id)) !!}
                                                            <span class="author">{{$lista->getNombre()}}</span>
                                                            <span class="preview">{{e($lista->descripcion)}}</span>
                                                            {!! Form::submit('', ['style' => 'border: none; background: none;']) !!}
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li class="view-all">
                                <a href="#"> See All </a>
                            </li>
                        @elseif(Auth::getUser()->hasRole(['productora']))
                            <img src="{{ asset(Auth::getUser()->getAvatar()) }}"
                                 class="user-image" alt="avatar"/>
                        @endif
                    @endif
                </ul>
            </li>
            <!-- end: MESSAGES DROPDOWN -->

            <!-- start: LANGUAGE SWITCHER -->
            <li class="dropdown">
                <a href class="dropdown-toggle" data-toggle="dropdown"> <i class="flag-icon flag-icon-us"></i> English </a>
                <ul role="menu" class="dropdown-menu dropdown-light fadeInUpShort">
                    <li>
                        <a href="#" class="menu-toggler"> Deutsch </a>
                    </li>
                    <li>
                        <a href="#" class="menu-toggler"> English </a>
                    </li>
                    <li>
                        <a href="#" class="menu-toggler"> Italiano </a>
                    </li>
                </ul>
            </li>
            <!-- end: LANGUAGE SWITCHER -->

            <!-- start: SALIR DROPDOWN -->
            <li class="dropdown">
                <a href="{{route('logout')}}" class="dropdown">{{trans('generals.logout')}}</a>
            </li>
            <!-- end: MESSAGES DROPDOWN -->

        </ul>
        <!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
        <div class="close-handle visible-xs-block menu-toggler" data-toggle="collapse" href=".navbar-collapse">
            <div class="arrow-left"></div>
            <div class="arrow-right"></div>
        </div>
        <!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
    </div>
    <button class="sidebar-mobile-toggler dropdown-off-sidebar btn hidden-md hidden-lg"  data-toggle-class="app-offsidebar-open" data-toggle-target="#app" data-toggle-click-outside="#off-sidebar">
        &nbsp;
    </button>
    <button class="dropdown-off-sidebar btn hidden-sm hidden-xs" data-toggle-class="app-offsidebar-open" data-toggle-target="#app" data-toggle-click-outside="#off-sidebar">
        &nbsp;
    </button>
    <!-- end: NAVBAR COLLAPSE -->
</header>
<!-- end: TOP NAVBAR -->