<!DOCTYPE html>
<html>
    <head>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <title>PSP - @yield('title')</title>
        <!-- Stylesheets -->
        @include('layouts.stylesheets', ['plantilla' => 'adminlte'])
        <!-- Stylesheets -->
        <!-- Stylesheets/Views -->
        @yield('css')
        <!-- Stylesheets/Views -->

        <!-- Head Libs -->
        {!! Html::script('adminlte/plugins/jQuery/jQuery-2.1.4.min.js') !!}
        <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    </head>

    <body class="skin-red-light">
        <div class="wrapper">
            @include('layouts.admin.header')
            @include('layouts.admin.sidebar')
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>@yield('dashboard')</h1>
                </section>
                <section class="content">
                    @yield('content')
                </section>
            </div>
        </div>

        @include('layouts.admin.footer')

        <!-- Scripts -->
        @include('layouts.scripts', ['plantilla' => 'adminlte'])
        <!-- Scripts -->

        <!-- Scripts/Views -->
        @yield('script')
        <!-- Scripts/Views -->

    </body>
</html>
