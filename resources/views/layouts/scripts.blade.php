@if($plantilla == 'porto')
    {!! Html::script('assets/porto/vendor/jquery/jquery.js') !!}
    {!! Html::script('assets/porto/vendor/jquery.appear/jquery.appear.js') !!}
    {!! Html::script('assets/porto/vendor/jquery.easing/jquery.easing.js') !!}
    {!! Html::script('assets/porto/vendor/jquery-cookie/jquery-cookie.js') !!}
    {!! Html::script('assets/porto/vendor/bootstrap/js/bootstrap.js') !!}
    {!! Html::script('assets/porto/vendor/common/common.js') !!}
    {!! Html::script('assets/porto/vendor/jquery.validation/jquery.validation.js') !!}
    {!! Html::script('assets/porto/vendor/jquery.stellar/jquery.stellar.js') !!}
    {!! Html::script('assets/porto/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js') !!}
    {!! Html::script('assets/porto/vendor/jquery.gmap/jquery.gmap.js') !!}
    {!! Html::script('assets/porto/vendor/jquery.lazyload/jquery.lazyload.js') !!}
    {!! Html::script('assets/porto/vendor/isotope/jquery.isotope.js') !!}
    {!! Html::script('assets/porto/vendor/owl.carousel/owl.carousel.js') !!}
    {!! Html::script('assets/porto/vendor/magnific-popup/jquery.magnific-popup.js') !!}
    {!! Html::script('assets/porto/vendor/vide/vide.js') !!}
     <!-- Theme Base, Components and Settings -->
    {!! Html::script('assets/porto/js/theme.js') !!}
     <!-- Theme Base, Components and Settings -->
    <!-- Specific Page Vendor and Views -->
    {!! Html::script('assets/porto/vendor/rs-plugin/js/jquery.themepunch.tools.min.js') !!}
    {!! Html::script('assets/porto/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js') !!}
    {!! Html::script('assets/porto/vendor/rs-plugin/js/extensions/revolution.extension.actions.min.js') !!}
    {!! Html::script('assets/porto/vendor/rs-plugin/js/extensions/revolution.extension.carousel.min.js') !!}
    {!! Html::script('assets/porto/vendor/rs-plugin/js/extensions/revolution.extension.kenburn.min.js') !!}
    {!! Html::script('assets/porto/vendor/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js') !!}
    {!! Html::script('assets/porto/vendor/rs-plugin/js/extensions/revolution.extension.migration.min.js') !!}
    {!! Html::script('assets/porto/vendor/rs-plugin/js/extensions/revolution.extension.navigation.min.js') !!}
    {!! Html::script('assets/porto/vendor/rs-plugin/js/extensions/revolution.extension.parallax.min.js') !!}
    {!! Html::script('assets/porto/vendor/rs-plugin/js/extensions/revolution.extension.slideanims.min.js') !!}
    {!! Html::script('assets/porto/vendor/rs-plugin/js/extensions/revolution.extension.video.min.js') !!}
    <!-- Specific Page Vendor and Views -->
    {!! Html::script('assets/porto/vendor/circle-flip-slideshow/js/jquery.flipshow.js') !!}
    {!! Html::script('assets/porto/js/views/view.home.js') !!}
    <!-- Theme Custom -->
    {!! Html::script('assets/porto/js/custom.js') !!}
    <!-- Theme Initialization Files -->
    {!! Html::script('assets/porto/js/theme.init.js') !!}
    <!-- Notifications -->
    {!! Html::script('library/pnotify/dist/pnotify.js') !!}
    {!! Html::script('library/pnotify/dist/pnotify.buttons.js') !!}
    {!! Html::script('library/pnotify/dist/pnotify.animate.js') !!}
    {!! Html::script('library/pnotify/dist/pnotify.desktop.js') !!}
@elseif($plantilla == 'adminlte')
    {!! Html::script('bootstrap/js/bootstrap.min.js') !!}
    {!! Html::script('adminlte/plugins/datepicker/bootstrap-datepicker.js') !!}
    {!! Html::script('adminlte/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('adminlte/plugins/datatables/dataTables.bootstrap.js') !!}
    {!! Html::script('adminlte/js/app.js') !!}
@elseif($plantilla == 'packet')
    <!-- start: Packet JAVASCRIPTS -->
    {!! Html::script('library/jquery/dist/jquery.min.js') !!}
    {!! Html::script('library/bootstrap/dist/js/bootstrap.min.js') !!}
    {!! Html::script('library/components-modernizr/modernizr.js') !!}
    {!! Html::script('library/js-cookie/src/js.cookie.js') !!}
    {!! Html::script('library/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') !!}
    {!! Html::script('library/jquery-fullscreen/jquery.fullscreen-min.js') !!}
    {!! Html::script('library/switchery/dist/switchery.min.js') !!}
    {!! Html::script('library/jquery.knobe/dist/jquery.knob.min.js') !!}
    {!! Html::script('library/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js') !!}
    {!! Html::script('library/jquery-numerator/jquery-numerator.js') !!}
    {!! Html::script('library/slick.js/slick/slick.min.js') !!}
    {!! Html::script('library/spin.js/spin.js') !!}
    {!! Html::script('library/ladda/dist/ladda.min.js') !!}
    {!! Html::script('library/ladda/dist/ladda.jquery.min.js') !!}
    {!! Html::script('library/datatables.net/js/jquery.dataTables.min.js') !!}
    {!! Html::script('library/datatables.net-bs/js/dataTables.bootstrap.min.js') !!}
    <!-- Notifications -->
    {!! Html::script('library/pnotify/dist/pnotify.js') !!}
    {!! Html::script('library/pnotify/dist/pnotify.buttons.js') !!}
    {!! Html::script('library/pnotify/dist/pnotify.animate.js') !!}
    {!! Html::script('library/pnotify/dist/pnotify.desktop.js') !!}
    {!! Html::script('assets/packet/js/letter-icons.js') !!}
    {!! Html::script('assets/packet/js/main.js') !!}
    <!-- end: Packet JAVASCRIPTS -->

@endif