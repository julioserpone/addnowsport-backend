<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <title>{!! $message->getSubject() !!}</title>
        <meta name="description" content="PSP">
        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="author" content="Reysmer Valle">
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>
    <body bgcolor="#FFFFFF" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none;height: 100%;width: 100%!important;">
        <table class="head-wrap" bgcolor="#DA4453" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;width: 100%;">
            <tr style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">
                <td style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;"></td>
                <td class="header container" style="margin: 0 auto!important;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;display: block!important;max-width: 600px!important;clear: both!important;">
                    <div class="content" style="margin: 0 auto;padding: 15px;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;max-width: 600px;display: block;">
                        <table bgcolor="#DA4453" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;width: 100%;">
                        </table>
                    </div>
                </td>
                <td style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;"></td>
            </tr>
        </table>
        <table class="body-wrap" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;width: 100%;">
            <tr style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">
                <td style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;"></td>
                <td class="container" bgcolor="#FFFFFF" style="margin: 0 auto!important;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;display: block!important;max-width: 600px!important;clear: both!important;">
                    <div class="content" style="margin: 0 auto;padding: 15px;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;max-width: 600px;display: block;">
                        <table style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;width: 100%;">
                            <tr style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">
                                <td style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">
                                    @yield('contenido')
                                    <table class="social" width="100%" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;background-color: #ebebeb;width: 100%;">
                                        <tr style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">
                                            <td style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">
                                                <table align="left" class="column" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;width: 280px;float: left;min-width: 279px;">
                                                    <tr style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">
                                                        <td style="margin: 0;padding: 15px;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">				
                                                            <h5 class="" style="margin: 0;padding: 0;font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 900;font-size: 17px;">Redes sociales:</h5>
                                                            <p class="" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;">
                                                                <a class="soc-btn fb" href="https://es-la.facebook.com" target="_blank" style="margin: 0;padding: 3px 7px;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;color: #FFF;font-size: 12px;margin-bottom: 10px;text-decoration: none;font-weight: bold;display: block;text-align: center;background-color: #DE5967!important;">
                                                                    <img src="{{ $message->embed('images/social/facebook.png') }}" alt="facebook" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;max-width: 100%;">
                                                                </a>
                                                                <a class="soc-btn tw" href="https://twitter.com" target="_blank" style="margin: 0;padding: 3px 7px;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;color: #FFF;font-size: 12px;margin-bottom: 10px;text-decoration: none;font-weight: bold;display: block;text-align: center;background-color: #1daced!important;">
                                                                    <img src="{{ $message->embed('images/social/twitter.png') }}" alt="twitter" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;max-width: 100%;">
                                                                </a>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table align="left" class="column" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;width: 280px;float: left;min-width: 279px;">
                                                    <tr style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">
                                                        <td style="margin: 0;padding: 15px;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">				
                                                            <h5 class="" style="margin: 0;padding: 0;font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;line-height: 1.1;margin-bottom: 15px;color: #000;font-weight: 900;font-size: 17px;">Información de contacto:</h5>												
                                                            <p style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;">
                                                                Teléfono: <strong style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">+54 (115) 0314713 / Int 822</strong><br style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">
                                                                Correo: <strong style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;"><a href="emailto:sorporte@ragzZa.com" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;color: #2BA6CB;">sorporte@ragzZa.com</a></strong>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </table><!-- /column 2 -->
                                                <span class="clear" style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;display: block;clear: both;"></span>	
                                            </td>
                                        </tr>
                                    </table><!-- /social & contact -->
                                </td>
                            </tr>
                        </table>
                    </div><!-- /content -->
                </td>
                <td style="margin: 0;padding: 0;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;"></td>
            </tr>
        </table>
        
    </body>
</html>