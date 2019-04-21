<?php

#Rutas perfil PRODUCTORA
Route::group(['middleware' => ['cors'], 'prefix' => 'v1'], function() {

    Route::group(['prefix' => 'productora'], function() {

            Route::post('/{productora_id}/image', 'ProductoraController@cambiarImagenProductora');
            Route::get('/{productora_id}/image', 'ProductoraController@getProductoraImagen');
            Route::post('/crear', 'ProductoraController@crearProductora');
            Route::post('/{productora_id}', 'ProductoraController@actualizarProductora');
            Route::delete('/{productora_id}', 'ProductoraController@eliminarProductora');
            Route::get('/', 'ProductoraController@showAllProductora');
            Route::get('/{productora_id}', 'ProductoraController@showProductora');
            Route::get('venta/all', 'VentasController@showAllVentas');
            Route::get('/venta/{venta_id}/', 'VentasController@showVenta');

        Route::group(['prefix' => 'ventas'], function() {

            //Filtros
            Route::group(['prefix' => 'filtro'], function(){

                Route::get('/mediosdepago', 'ProductoraController@showMediosDePago');
                Route::get('/{productora_id}/distancias', 'ProductoraController@showDistancias');
                Route::get('/{productora_id}/competencias', 'ProductoraController@showCompetencias');
                Route::get('/fechas', 'ProductoraController@showFechas');

            });

            ///
            Route::get('/{productora_id}/all', 'VentasController@showAllVentas');
            Route::get('/{productora_id}/{venta_id}/', 'VentasController@showVenta');

        });

        });

    Route::group(['prefix' => 'usuario'], function() {


        Route::get('/accesos/', 'UsuarioController@getAllAccesoUsuarios');
        Route::get('/tipos/', 'UsuarioController@getAllTipoUsuarios');
        Route::get('/paises/', 'UsuarioController@getAllPaisesUsuarios');
        Route::get('/All/', 'UsuarioController@showAllUsuarios');
        Route::get('/{usuario_id}/', 'UsuarioController@showUsuario');


    });

    Route::group(['prefix' => 'disciplinas'], function() {

        Route::get('/all', 'DisciplinasController@showSubDisciplinasByDisciplinas');

    });

    Route::group(['prefix' => 'distancias'], function() {

        Route::group(['prefix' => 'categorias'], function() {

            Route::get('/crear', 'CategoriasController@vincularDistancias');
            Route::delete('/{relacion_id}', 'CategoriasController@eliminarDistancia');
            Route::get('/all', 'CategoriasController@showAllDistancias');
            Route::get('/{relacion_id}', 'CategoriasController@showDistancia');

        });

    });


    Route::group(['prefix' => 'administrador'], function() {

        Route::group(['prefix' => 'ventas'], function() {

            //Filtros
            Route::group(['prefix' => 'filtro'], function() {

                Route::get('/mediosdepago', 'VentasController@showMediosDePago');
                Route::get('/distancias', 'VentasController@showDistancias');
                Route::get('/fechas', 'VentasController@showFechas');
                Route::get('/productoras', 'VentasController@showProductoras');

            });

            ///
            Route::get('/all', 'VentasController@showAllVentas');
            Route::get('/{venta_id}/', 'VentasController@showVenta');

        });

        Route::group(['prefix' => 'filtro'], function() {

            Route::get('/productoras', 'ProductoraController@showAllProductora');
            Route::get('/competencias/estados', 'CompetenciasController@ShowEstados');

        });

        Route::post('/roles/{usuario_id}', 'AdministradorController@modificarRoll');


    });


    Route::group(['prefix' => 'slider'], function() {

        Route::post('/crear', 'SliderController@crearSlider');
        Route::get('/', 'SliderController@showAllSlider');
        Route::get('/{slider_id}', 'SliderController@showSlider');
        Route::get('/foto/{foto_id}', 'SliderController@getFotoSlider');
        Route::post('/addFoto', 'SliderController@agregarFotoSlider');
        Route::post('/{slider_id}/act', 'SliderController@agregarInformacionFotoSlider');
        Route::delete('/{slider_id}', 'SliderController@eliminarSlider');
    });

    Route::group(['prefix' => 'templateslider'], function() {

        Route::post('/crear', 'templateSliderController@crearTemplateSlider');
        Route::get('/', 'templateSliderController@showAllTemplateSlider');
        Route::get('/{slider_id}', 'templateSliderController@showTemplateSlider');
        Route::get('/foto/{foto_id}', 'templateSliderController@getFotoTemplateSlider');
        Route::post('/addFoto', 'templateSliderController@agregarTemplateFotoSlider');
        Route::post('/{slider_id}/act', 'templateSliderController@agregarInformacionTemplateFotoSlider');
        Route::delete('/{slider_id}', 'templateSliderController@eliminarTemplateSlider');
    });

});