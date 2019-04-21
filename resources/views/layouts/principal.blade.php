<!DOCTYPE html>
<html>
    <head>
        <!-- Basic -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>@yield('title') Kairos Now Play :: Es hora de jugar ::</title>	

        <!-- Twitter Card data --> 
        <meta name="twitter:card" content="summary"> 
        <meta name="twitter:site" content="@publisher_handle"> 
        <meta name="twitter:title" content="Karios Now Play - Es hora de jugar"> 
        <meta name="twitter:description" content=""> 
        <meta name="twitter:creator" content="@author_handle"> 
        <meta name="twitter:image" content="http://www.kairosnowplay.com/images/logo_footer.png">

        <!-- Open Graph data --> 
        <meta property="og:title" content="Karios Now Play - Es hora de jugar" /> 
        <meta property="og:type" content="article" /> 
        <meta property="og:url" content="http://www.kairosnowplay.com/" />
        <meta property="og:image" content="http://www.kairosnowplay.com/images/logo_footer.png" />
        <meta property="og:description" content="" /> 
        <meta property="og:site_name" content="Kairos Now Play" /> 

        <!-- Favicon -->
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="img/apple-touch-icon.png">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Web Fonts  -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

        <!-- Stylesheets -->
        @include('layouts.stylesheets', ['plantilla' => 'porto'])
        <!-- Stylesheets -->

        <!-- Stylesheets/Views -->
        @yield('css')
        <!-- Stylesheets/Views -->

        <!-- Head Libs -->
        {!! Html::script('assets/porto/vendor/modernizr/modernizr.js') !!}

    </head>
    <body>
        <div class="body">

            @include('layouts.header')

            @yield('content')

            @include('layouts.footer')
        </div>

        <!-- Scripts -->
        @include('layouts.scripts', ['plantilla' => 'porto'])
        <!-- Scripts -->

        <!-- Scripts/Views -->
        @yield('script')
        <!-- Scripts/Views -->

        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

        @section('jsMessages')

        @show
    </body>
</html>

