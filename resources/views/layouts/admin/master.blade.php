<!DOCTYPE html>
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <title>PSP - @yield('title')</title>
        <!-- start: META -->
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0,
              user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- end: META -->
        <!-- start: GOOGLE FONTS -->
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,
              400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
              rel="stylesheet" type="text/css" />
        <!-- end: GOOGLE FONTS -->
        <!-- start: MAIN CSS -->
        @include('layouts.stylesheets',['plantilla' => 'packet'])
        <!-- end: MAIN CSS -->
        <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
        @yield('styles')
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
        <!-- start: Packet CSS -->
        {!! Html::style('assets/packet/css/styles.css') !!}
        {!! Html::style('assets/packet/css/plugins.css') !!}
        {!! Html::style('assets/packet/css/themes/lyt1-theme-1.css') !!}
        {!! Html::script('library/jquery/dist/jquery.min.js') !!}
        <!-- end: Packet CSS -->
        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico" />
    </head>
    <!-- end: HEAD -->
    <body>
        <div id="app">
            <!-- sidebar -->
            @include('layouts.admin.sidebar-left')
            <!-- / sidebar -->
            <div class="app-content">
                <!-- start: TOP NAVBAR -->
                @include('layouts.admin.header')
                <!-- end: TOP NAVBAR -->
                <div class="main-content" >
                    <div class="wrap-content container" id="container">
                        <!-- start: BREADCRUMB -->
                        <br>
                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- start: FOOTER -->
<!--            <footer>
                <div class="footer-inner">
                    <div class="pull-left">
                        &copy; <span class="current-year"></span>
                        <span class="text-bold text-uppercase">PSP - Argentina</span>
                        <span>Todos los derechos reservados</span>
                    </div>
                    <div class="pull-right">
                        <span class="go-top"><i class="ti-angle-up"></i></span>
                    </div>
                </div>
            </footer>-->
            <!-- end: FOOTER -->
            <!-- start: OFF-SIDEBAR -->
            @include('layouts.admin.sidebar-right')
            <!-- end: OFF-SIDEBAR -->
            <!-- start: SETTINGS -->
<!--            <div class="settings panel panel-default hidden-xs hidden-sm" id="settings">
                <button data-toggle-class="active" data-toggle-target="#settings" class="btn btn-default">
                    <i class="fa fa-spin fa-gear"></i>
                </button>
                <div class="panel-heading">
                    Style Selector
                </div>
                <div class="panel-body">
                     start: FIXED HEADER 
                    <div class="setting-box clearfix">
                        <span class="setting-title pull-left"> Fixed header</span>
                        <span class="setting-switch pull-right">
                            <input type="checkbox" class="js-switch" id="fixed-header" />
                        </span>
                    </div>
                     end: FIXED HEADER 
                     start: FIXED SIDEBAR 
                    <div class="setting-box clearfix">
                        <span class="setting-title pull-left">Fixed sidebar</span>
                        <span class="setting-switch pull-right">
                            <input type="checkbox" class="js-switch" id="fixed-sidebar" />
                        </span>
                    </div>
                     end: FIXED SIDEBAR 
                     start: CLOSED SIDEBAR 
                    <div class="setting-box clearfix">
                        <span class="setting-title pull-left">Closed sidebar</span>
                        <span class="setting-switch pull-right">
                            <input type="checkbox" class="js-switch" id="closed-sidebar" />
                        </span>
                    </div>
                     end: CLOSED SIDEBAR 
                     start: FIXED FOOTER 
                    <div class="setting-box clearfix">
                        <span class="setting-title pull-left">Fixed footer</span>
                        <span class="setting-switch pull-right">
                            <input type="checkbox" class="js-switch" id="fixed-footer" />
                        </span>
                    </div>
                     end: FIXED FOOTER 
                     start: THEME SWITCHER 
                    <div class="colors-row setting-box">
                        <div class="color-theme lyt1-theme-1">
                            <div class="color-layout">
                                <label>
                                    <input type="radio" name="setting-theme" value="lyt1-theme-1">
                                    <span class="fa fa-check-circle lyt-check text-extra-large"></span> <span class="split header"> <span class="color th-header"></span> <span class="color th-collapse"><i class="color-button"></i></span> </span> <span class="split"> <span class="color th-sidebar"><i class="element"></i></span> <span class="color th-body"></span> </span> </label>
                            </div>
                        </div>
                        <div class="color-theme lyt1-theme-2">
                            <div class="color-layout">
                                <label>
                                    <input type="radio" name="setting-theme" value="lyt1-theme-2">
                                    <span class="fa fa-check-circle lyt-check text-extra-large"></span> <span class="split header"> <span class="color th-header"></span> <span class="color th-collapse"><i class="color-button"></i></span> </span> <span class="split"> <span class="color th-sidebar"><i class="element"></i></span> <span class="color th-body"></span> </span> </label>
                            </div>
                        </div>
                    </div>
                    <div class="colors-row setting-box">
                        <div class="color-theme lyt1-theme-3">
                            <div class="color-layout">
                                <label>
                                    <input type="radio" name="setting-theme" value="lyt1-theme-3">
                                    <span class="fa fa-check-circle lyt-check text-extra-large"></span> <span class="split header"> <span class="color th-header"></span> <span class="color th-collapse"><i class="color-button"></i></span> </span> <span class="split"> <span class="color th-sidebar"><i class="element"></i></span> <span class="color th-body"></span> </span> </label>
                            </div>
                        </div>
                        <div class="color-theme lyt1-theme-4">
                            <div class="color-layout">
                                <label>
                                    <input type="radio" name="setting-theme" value="lyt1-theme-4">
                                    <span class="fa fa-check-circle lyt-check text-extra-large"></span> <span class="split header"> <span class="color th-header"></span> <span class="color th-collapse"><i class="color-button"></i></span> </span> <span class="split"> <span class="color th-sidebar"><i class="element"></i></span> <span class="color th-body"></span> </span> </label>
                            </div>
                        </div>
                    </div>
                    <div class="colors-row setting-box">
                        <div class="color-theme lyt1-theme-5">
                            <div class="color-layout">
                                <label>
                                    <input type="radio" name="setting-theme" value="lyt1-theme-5">
                                    <span class="fa fa-check-circle lyt-check text-extra-large"></span> <span class="split header"> <span class="color th-header"></span> <span class="color th-collapse"><i class="color-button"></i></span> </span> <span class="split"> <span class="color th-sidebar"><i class="element"></i></span> <span class="color th-body"></span> </span> </label>
                            </div>
                        </div>
                        <div class="color-theme lyt1-theme-6">
                            <div class="color-layout">
                                <label>
                                    <input type="radio" name="setting-theme" value="lyt1-theme-6">
                                    <span class="fa fa-check-circle lyt-check text-extra-large"></span> <span class="split header"> <span class="color th-header"></span> <span class="color th-collapse"><i class="color-button"></i></span> </span> <span class="split"> <span class="color th-sidebar"><i class="element"></i></span> <span class="color th-body"></span> </span> </label>
                            </div>
                        </div>
                    </div>
                     end: THEME SWITCHER 
                    <div class="panel-footer">
                        <button class="btn btn-primary ladda-button btn-squared btn-sm btn-o" data-style="slide-up" data-spinner-size="10" data-spinner-color="#999999" id="reset-layout">
                            <span class="ladda-label">Reset</span>
                        </button>
                        <button class="btn btn-primary ladda-button pull-right btn-squared btn-sm btn-wide" data-style="slide-up" data-spinner-size="10" id="save-layout">
                            <span class="ladda-label">Save</span>
                        </button>
                    </div>
                </div>
            </div>-->
            <!-- end: SETTINGS -->
        </div>
        @include('layouts.scripts',['plantilla' => 'packet'])
        
        <!-- start: JavaScript Event Handlers for this page -->
        @yield('scripts')

        @yield('run-scripts')
        <!-- end: JavaScript Event Handlers for this page -->
    </body>
</html>
