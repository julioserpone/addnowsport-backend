<header class="main-header">
    <a class="logo"><b>Play Social</b> Pass</a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset('adminlte/img/user2-160x160.jpg') }}" class="user-image" alt="User Image"/>
                    <span class="hidden-xs">
                        @if(Session::has('name'))
                            {{Session::get('name')}}
                        @endif
                    </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ asset('adminlte/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" />

                            @if(Session::has('name'))
                                <p>{{Session::get('name')}}</p>
                                <small>{{Session::get('member')}}</small>
                            @endif

                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{route('logout')}}" class="btn btn-default btn-flat">{{   trans("generals.logout")   }}</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>