<?php

#Rutas Administrativas
Route::group(['prefix' => 'system'], function() {

    Route::group(['roles' => ['system'], 'middleware' => ['jwt.verifytoken', 'jwt.auth', 'roles']], function() {

        #Administracion de Usuarios
        Route::group(['prefix' => 'usuarios'], function() {
            Route::get('/', ['as' => 'todos.administrar.system', 'uses' => 'UsuarioController@showAll']);
            Route::get('/{id}', ['as' => 'mostrar.administrar.system', 'uses' => 'UsuarioController@show']);
            Route::post('/', ['as' => 'crear.administrar.system', 'uses' => 'UsuarioController@store']);
            Route::post('/roles', ['as' => 'roles.administrar.system', 'uses' => 'AdministradorController@modificarRoll']);
            Route::put('/{id}', ['as' => 'actualizar.administrar.system', 'uses' => 'UsuarioController@update']);
            Route::delete('/{id}', ['as' => 'eliminar.administrar.system', 'uses' => 'UsuarioController@destroy']);
        });

        #Administracion de Productoras
        Route::group(['prefix' => 'productora'], function() {
            Route::get('/', ['as' => 'todos.productoras.system', 'uses' => 'AdministradorController@mostrarProductoras']);
            Route::get('/administracion', ['as' => 'administracion.productoras.system', 'uses' => 'AdministradorController@mostrarAdministracionProductoras']);
            Route::get('/productoras-competencias', ['as' => 'administracion.productoras.system', 'uses' => 'AdministradorController@mostrarCompetenciasProductoras']);
            Route::get('/{id}', ['as' => 'mostrar.productora.system', 'uses' => 'AdministradorController@mostrarProductora']);
            Route::post('/', ['as' => 'crear.productora.system', 'uses' => 'AdministradorController@crearProductora']);
            Route::delete('/{id}', ['as' => 'eliminar.productora.system', 'uses' => 'AdministradorController@eliminarProductora']);
        });

        #Codigos
        Route::group(['prefix' => 'codigos'], function() {
            Route::get('/', ['as' => 'grid.codigos.system', 'uses' => 'CodigoController@index']);
            Route::get('search', ['as' => 'buscar.codigos.system', 'uses' => 'CodigoController@search']);
            Route::get('/{id}', ['as' => 'mostrar.codigo.system', 'uses' => 'CodigoController@show']);
            Route::get('/{id}/estatus/{estatus}', ['as' => 'estatus.codigos.system', 'uses' => 'CodigoController@cambiarEstatus']);
            Route::post('/', ['as' => 'guardar.codigos.system', 'uses' => 'CodigoController@store']);
            Route::put('/{id}', ['as' => 'actualizar.codigos.system', 'uses' => 'CodigoController@update']);
            Route::delete('/{id}', ['as' => 'eliminar.codigos.system', 'uses' => 'CodigoController@destroy']);
        });

        #Mailing
        Route::group(['prefix' => 'mailing'], function() {
            Route::post('/', ['as' => 'mailing.system', 'uses' => 'AdministradorController@postMailing']);
        });

        #Administracion de las Transferencias
        Route::group(['prefix' => 'transferencias'], function() {
            Route::get('/{type}', ['as' => 'exportar.transferencias.system', 'uses' => 'OfficeController@export']);
            Route::post('/import', ['as' => 'importar.transferencias.system', 'uses' => 'OfficeController@import']);
        });

        #Disciplinas
        Route::group(['prefix' => 'disciplinas'], function() {
            Route::get('/', ['as' => 'todos.disciplinas.system', 'uses' => 'DisciplinasController@mostrarDisciplinas']);
            Route::get('/sub', ['as' => 'mostrar.disciplinas.system', 'uses' => 'DisciplinasController@showSubDisciplinasByDisciplinas']);
            Route::get('/{id}', ['as' => 'mostrar.disciplinas.system', 'uses' => 'DisciplinasController@mostrarDisciplina']);
            Route::post('/', ['as' => 'crear.disciplinas.system', 'uses' => 'DisciplinasController@crearDisciplina']);
            Route::post('/sub', ['as' => 'crear-sub.disciplinas.system', 'uses' => 'DisciplinasController@crearSubDisciplina']);
            Route::put('/{id}', ['as' => 'actualizar.disciplinas.system', 'uses' => 'DisciplinasController@actualizarDisciplina']);
            Route::put('/sub/{id}', ['as' => 'actualizar-sub.disciplinas.system', 'uses' => 'DisciplinasController@actualizarSubDisciplina']);
            Route::delete('/{id}', ['as' => 'eliminar.disciplinas.system', 'uses' => 'DisciplinasController@eliminarDisciplina']);
        });

        #Ventas
        Route::group(['prefix' => 'ventas'], function() {
            Route::get('/', ['as' => 'mostrar.ventas.system', 'uses' => 'VentasController@showAllVentas']);
            Route::get('/{id}/', ['as' => 'mostrar.ventas.system', 'uses' => 'VentasController@showVenta']);
        });

        #Slider del Home sel sitio Web
        Route::group(['prefix' => 'slider'], function() {
            Route::get('/', ['as' => 'todos.slider.system', 'uses' => 'SliderController@showAllSlider']);
            Route::get('/{id}', ['as' => 'mostrar-slider.slider.system', 'uses' => 'SliderController@showSlider']);
            Route::get('/foto/{id}', ['as' => 'mostrar-foto.slider.system', 'uses' => 'SliderController@getFotoSlider']);
            Route::post('/crear', ['as' => 'crear.slider.system', 'uses' => 'SliderController@crearSlider']);
            Route::post('/addFoto', ['as' => 'crear-foto.slider.system', 'uses' => 'SliderController@agregarFotoSlider']);
            Route::post('/{id}/act', ['as' => 'crear-informacion.slider.system', 'uses' => 'SliderController@agregarInformacionFotoSlider']);
            Route::delete('/{id}', ['as' => 'eliminar.slider.system', 'uses' => 'SliderController@eliminarSlider']);
        });

        #Administracion de las plantilla para los sliders
        Route::group(['prefix' => 'templateslider'], function() {
            Route::get('/', ['as' => 'mostrar-productoras-ventas.filtro.system', 'uses' => 'templateSliderController@showAllTemplateSlider']);
            Route::get('/{slider_id}', ['as' => 'mostrar-productoras-ventas.filtro.system', 'uses' => 'templateSliderController@showTemplateSlider']);
            Route::get('/foto/{foto_id}', ['as' => 'mostrar-productoras-ventas.filtro.system', 'uses' => 'templateSliderController@getFotoTemplateSlider']);
            Route::post('/crear', ['as' => 'mostrar-productoras-ventas.filtro.system', 'uses' => 'templateSliderController@crearTemplateSlider']);
            Route::post('/addFoto', ['as' => 'mostrar-productoras-ventas.filtro.system', 'uses' => 'templateSliderController@agregarTemplateFotoSlider']);
            Route::post('/{slider_id}/act', ['as' => 'mostrar-productoras-ventas.filtro.system', 'uses' => 'templateSliderController@agregarInformacionTemplateFotoSlider']);
            Route::delete('/{slider_id}', ['as' => 'mostrar-productoras-ventas.filtro.system', 'uses' => 'templateSliderController@eliminarTemplateSlider']);
        });

        #Filtros
        Route::group(['prefix' => 'filtro'], function() {
            Route::get('/productoras', ['as' => 'mostrar-productoras.filtro.system', 'uses' => 'ProductoraController@showAllProductora']);
            Route::get('/competencias-estados', ['as' => 'mostrar-competencias-estados.filtro.system', 'uses' => 'CompetenciasController@ShowEstados']);
            Route::get('/mediosdepago', ['as' => 'mostrar-medios.filtro.system', 'uses' => 'VentasController@showMediosDePago']);
            Route::get('/distancias', ['as' => 'mostrar-distancias.filtro.system', 'uses' => 'VentasController@showDistancias']);
            Route::get('/fechas', ['as' => 'mostrar-fechas.filtro.system', 'uses' => 'VentasController@showFechas']);
            Route::get('/productoras-ventas', ['as' => 'mostrar-productoras-ventas.filtro.system', 'uses' => 'VentasController@showProductoras']);
            Route::get('/accesos', ['as' => 'mostrar-aceesos-usuarios.filtro.system', 'uses' => 'UsuarioController@getAllAccesoUsuarios']);
            Route::get('/tipos', ['as' => 'mostrar-productoras-usuarios.filtro.system', 'uses' => 'UsuarioController@getAllTipoUsuarios']);
            Route::get('/usuarios', ['as' => 'mostrar-usuarios.filtro.system', 'uses' => 'UsuarioController@showAllUsuarios']);
            Route::get('/{id}', ['as' => 'mostrar-usuario.filtro.system', 'uses' => 'UsuarioController@showUsuario']);
        });
        
        #Office
        Route::group(['prefix' => 'office'], function() {
            Route::post('/exportar', ['as' => 'exportar-resultado.filtro.system', 'uses' => 'OfficeController@exportarResultados']);
            Route::post('/importar', ['as' => 'importar-archivo.system', 'uses' => 'OfficeController@importarResultados']);
        });

    });
});
