@if($plantilla == 'porto')
<!-- Vendor CSS -->
{!! Html::style('assets/porto/vendor/bootstrap/css/bootstrap.css') !!}
{!! Html::style('assets/porto/vendor/font-awesome/css/font-awesome.css') !!}
{!! Html::style('assets/porto/vendor/simple-line-icons/css/simple-line-icons.css') !!}
{!! Html::style('assets/porto/vendor/owl.carousel/assets/owl.carousel.min.css') !!}
{!! Html::style('assets/porto/vendor/owl.carousel/assets/owl.theme.default.min.css') !!}
{!! Html::style('assets/porto/vendor/magnific-popup/magnific-popup.css') !!}
<!-- Vendor CSS -->
<!-- Theme CSS -->
{!! Html::style('assets/porto/css/theme.css') !!}
{!! Html::style('assets/porto/css/theme-elements.css') !!}
{!! Html::style('assets/porto/css/theme-blog.css') !!}
{!! Html::style('assets/porto/css/theme-shop.css') !!}
{!! Html::style('assets/porto/css/theme-animate.css') !!}
<!-- Theme CSS -->
<!-- Current Page CSS -->
{!! Html::style('assets/porto/vendor/rs-plugin/css/settings.css', ['media' => 'screen']) !!}
{!! Html::style('assets/porto/vendor/rs-plugin/css/layers.css', ['media' => 'screen']) !!}
{!! Html::style('assets/porto/vendor/rs-plugin/css/navigation.css', ['media' => 'screen']) !!}
<!-- Current Page CSS -->
{!! Html::style('assets/porto/vendor/circle-flip-slideshow/css/component.css', ['media' => 'screen']) !!}
<!-- Skin CSS -->
{!! Html::style('assets/porto/css/skins/skin-psp-1.css') !!}
<!-- Skin CSS -->
<!-- Theme Custom CSS -->
{!! Html::style('assets/porto/css/custom.css') !!}
<!-- Theme Custom CSS -->
{!! Html::style('library/pnotify/dist/pnotify.css') !!}
{!! Html::style('library/pnotify/dist/pnotify.buttons.css') !!}
@elseif($plantilla == 'adminlte')
{!! Html::style('bootstrap/css/bootstrap.min.css') !!}
{!! Html::style('css/font-awesome.min.css') !!}
{!! Html::style('adminlte/css/AdminLTE.css') !!}
{!! Html::style('adminlte/css/skins/_all-skins.min.css') !!}
{!! Html::style('adminlte/plugins/datatables/dataTables.bootstrap.css') !!}

@elseif($plantilla == 'packet')
{!! Html::style('library/bootstrap/dist/css/bootstrap.min.css') !!}
{!! Html::style('library/components-font-awesome/css/font-awesome.min.css') !!}
{!! Html::style('library/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}
{!! Html::style('library/themify-icons/themify-icons.css') !!}
{!! Html::style('library/flag-icon-css/css/flag-icon.min.css') !!}
{!! Html::style('library/animate.css/animate.min.css') !!}
{!! Html::style('library/perfect-scrollbar/css/perfect-scrollbar.min.css') !!}
{!! Html::style('library/switchery/dist/switchery.min.css') !!}
{!! Html::style('library/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css') !!}
{!! Html::style('library/ladda/dist/ladda-themeless.min.css') !!}
{!! Html::style('library/slick.js/slick/slick.css') !!}
{!! Html::style('library/slick.js/slick/slick-theme.css') !!}
{!! Html::style('library/pnotify/dist/pnotify.css') !!}
{!! Html::style('library/pnotify/dist/pnotify.buttons.css') !!}
@endif
