<?php

#Rutas perfil PRODUCTORA
Route::group(['prefix' => 'productora'], function() {

    Route::group(['roles' => ['productora'], 'middleware' => ['jwt.verifytoken', 'jwt.auth', 'roles']], function() {

        #Codigos
        Route::group(['prefix' => 'codigos'], function() {
            Route::get('/{id}', ['as' => 'mostrar.codigo.productora', 'uses' => 'CodigoController@show']);
            Route::get('/', ['as' => 'grid.codigos.productora', 'uses' => 'CodigoController@index']);
            Route::get('search', ['as' => 'buscar.codigos.productora', 'uses' => 'CodigoController@search']);
            Route::get('/{id}/estatus/{estatus}', ['as' => 'estatus.codigos.productora', 'uses' => 'CodigoController@cambiarEstatus']);
            Route::post('/', ['as' => 'guardar.codigos.productora', 'uses' => 'CodigoController@store']);
            Route::put('/{id}', ['as' => 'actualizar.codigos.productora', 'uses' => 'CodigoController@update']);
            Route::delete('/{id}', ['as' => 'eliminar.codigos.productora', 'uses' => 'CodigoController@destroy']);
        });

        #Categorias
        Route::group(['prefix' => 'categorias'], function() {
            Route::get('/', ['as' => 'todos.categorias.productora', 'uses' => 'CategoriasController@mostrarCategorias']);
            Route::get('/{id}', ['as' => 'mostrar.categorias.productora', 'uses' => 'CategoriasController@mostrarCategoria']);
            Route::post('/', ['as' => 'crear.categorias.productora', 'uses' => 'CategoriasController@crearCategoria']);
            Route::put('/', ['as' => 'actualizar.categorias.productora', 'uses' => 'CategoriasController@actualizarCategoria']);
            Route::delete('/', ['as' => 'eliminar.categorias.productora', 'uses' => 'CategoriasController@eliminarCategoria']);
        });

        #Grupo de Categorias
        Route::group(['prefix' => 'grupo-categorias'], function() {
            Route::get('/', ['as' => 'todos.grupo-categorias.productora', 'uses' => 'CategoriasController@mostrarGrupoCategorias']);
            Route::get('/{id}', ['as' => 'mostrar.grupo-categorias.productora', 'uses' => 'CategoriasController@mostrarGrupoCategoria']);
            Route::post('/', ['as' => 'crear.codigos.grupo-categorias', 'uses' => 'CategoriasController@crearGrupoCategoria']);
            Route::put('/', ['as' => 'actualizar.grupo-categorias.productora', 'uses' => 'CategoriasController@modificarGrupoCategoria']);
            Route::delete('/', ['as' => 'eliminar.grupo-categorias.productora', 'uses' => 'CategoriasController@eliminarGrupoCategoria']);
        });

        #Competencias
        Route::group(['prefix' => 'competencias'], function() {

            /*
                Route::group(['prefix' => 'paso'], function() {
                Route::get('/1/{id}', ['as' => 'mostrar-paso1.competencias.productora', 'uses' => 'CompetenciasController@getCompetenciaPaso1']);
                Route::get('/2/{id}', ['as' => 'mostrar-paso1.competencias.productora', 'uses' => 'CompetenciasController@getCompetenciaPaso2']);
                Route::get('/3/{id}', ['as' => 'mostrar-paso3.competencias.productora', 'uses' => 'CompetenciasController@getCompetenciaPaso3']);
                Route::put('/1', ['as' => 'paso1.competencias.productora', 'uses' => 'CompetenciasController@competenciaPaso1']);
                Route::put('/2', ['as' => 'paso2.competencias.productora', 'uses' => 'CompetenciasController@competenciaPaso2']);
                Route::put('/3', ['as' => 'paso3.competencias.productora', 'uses' => 'CompetenciasController@competenciaPaso3']);
                Route::put('/4', ['as' => 'paso4.competencias.productora', 'uses' => 'CompetenciasController@competenciaPaso4']);
                Route::put('/5', ['as' => 'paso5.competencias.productora', 'uses' => 'CompetenciasController@competenciaPaso5']);
            });*/

            Route::get('/', ['as' => 'todos.competencias.productora', 'uses' => 'CompetenciasController@mostrarCompetencias']);
            Route::get('/porcentaje',['as' => 'mostrar-porcentaje.competencias.productora', 'uses' => 'CompetenciasController@mostrarPorcentaje']);
            Route::get('/incompletas', ['as' => 'incompletas-listado.competencias.productora', 'uses' => 'CompetenciasController@mostrarIncompletas']);
            Route::get('/continuar/{id}', ['as' => 'continuar-listado.competencias.productora', 'uses' => 'CompetenciasController@mostrarContinuar']);
            Route::get('/proximas', ['as' => 'proximos-todos.competencias.productora', 'uses' => 'CompetenciasController@mostrarProximasCompetencias']);
            Route::get('/premios/{id}', ['as' => 'imagenes-todos.competencias.productora', 'uses' => 'CompetenciasController@mostrarImagenesPremio']);
            Route::get('/premios/{id}{img}', ['as' => 'imagenes-todos.competencias.productora', 'uses' => 'CompetenciasController@mostrarImagenPremio']);
            Route::get('/patrocinador/{id}', ['as' => 'sponsors-todos.competencias.productora', 'uses' => 'CompetenciasController@mostrarImagenesPatrocinador']);
            Route::get('/galerias/{id}', ['as' => 'sponsors-todos.competencias.productora', 'uses' => 'CompetenciasController@mostrarImagenesGaleria']);
            Route::get('/templatesliders', ['as' => 'templateslider-todos.competencias.productora', 'uses' => 'CompetenciasController@mostrarTemplatesSliders']);
            Route::get('/templatesliders/{id}', ['as' => 'slider-id-todos.competencias.productora', 'uses' => 'CompetenciasController@mostrarImagenesTemplateSliders']);
            Route::get('/{id}', ['as' => 'mostrar.competencias.productora', 'uses' => 'CompetenciasController@mostrarCompetencia']);
            Route::post('/', ['as' => 'crear.competencias.productora', 'uses' => 'CompetenciasController@crearCompetencia']);

            Route::post('/finalizar', ['as' => 'finalizar.competencias.productora', 'uses' => 'CompetenciasController@finalizar']);
            Route::group(['prefix' => 'agregar'], function() {
                Route::post('/premio', ['as' => 'premio.agregar.competencias.productora', 'uses' => 'CompetenciasController@agregarImagenPremio']);
                Route::post('/patrocinador', ['as' => 'patrocinador.agregar.competencias.productora', 'uses' => 'CompetenciasController@agregarImagenSponsor']);
                Route::post('/galeria', ['as' => 'galeria.agregar.competencias.productora', 'uses' => 'CompetenciasController@agregarImagenGaleria']);
            });
            Route::put('/', ['as' => 'actualizar.competencias.productora', 'uses' => 'CompetenciasController@actualizarCompetenciaIncompleta']);

        //    Route::put('/{id}', ['as' => 'actualizar.competencias.productora', 'uses' => 'CompetenciasController@actualizarCompetencia']);
        //    Route::delete('/', ['as' => 'eliminar.competencias.productora', 'uses' => 'CompetenciasController@eliminarCompetencias']);
        //    Route::delete('/{id}', ['as' => 'eliminar.competencias.productora', 'uses' => 'CompetenciasController@eliminarCompetencia']);

        });

        #Circuitos
        Route::group(['prefix' => 'circuitos'], function() {
            Route::get('/', ['as' => 'todos.circuitos.productora', 'uses' => 'CircuitosController@mostrarCircuitos']);
            Route::get('/{id}', ['as' => 'mostrar.circuitos.productora', 'uses' => 'CircuitosController@mostrarCircuito']);
            Route::post('/', ['as' => 'crear.circuitos.productora', 'uses' => 'CircuitosController@crearCircuito']);
            Route::put('/', ['as' => 'actualizar.circuitos.productora', 'uses' => 'CircuitosController@actualizar']);
            Route::delete('/{id}', ['as' => 'eliminar.circuitos.productora', 'uses' => 'CircuitosController@eliminar']);
        });

        #Distancias
        Route::group(['prefix' => 'distancias'], function() {
            Route::get('/', ['as' => 'todos.distancias.productora', 'uses' => 'DistanciasController@mostrarDistancias']);
            Route::get('/{id}', ['as' => 'mostrar.distancias.productora', 'uses' => 'DistanciasController@mostrarDistancia']);
            Route::post('/', ['as' => 'crear.distancias.productora', 'uses' => 'DistanciasController@crearDistancia']);
            Route::put('/{id}', ['as' => 'actualizar.distancias.productora', 'uses' => 'DistanciasController@actualizarDistancia']);
            Route::delete('/{id}', ['as' => 'eliminar.distancias.productora', 'uses' => 'DistanciasController@eliminarDistancia']);
        });

        #Disciplinas
        Route::group(['prefix' => 'disciplinas'], function() {
            Route::get('/', ['as' => 'todos.disciplinas.productora', 'uses' => 'DisciplinasController@mostrarDisciplinas']);
        });

        #Perfil Productora
        Route::group(['prefix' => 'perfil'], function() {
            Route::get('/',['as' => 'mostrar.perfil.productora', 'uses' => 'ProductoraController@mostrarDatosProductora']);
            Route::get('/porcentaje',['as' => 'mostrar-porcentaje.perfil.productora', 'uses' => 'ProductoraController@getPorcentaje']);
            Route::get('/{id}/image', ['as' => 'mostrar.imagen.perfil.productora', 'uses' => 'ProductoraController@getProductoraImagen']);
            Route::post('/{id}/image', ['as' => 'actualizar.imagen.perfil.productora', 'uses' => 'ProductoraController@cambiarImagenProductora']);
            Route::put('/', ['as' => 'actualizar.perfil.productora', 'uses' => 'ProductoraController@actualizarProductora']);
        });

        #Datos Bancarios
        Route::group(['prefix' => 'datosbancarios'], function() {
            Route::get('/', ['as' => 'mostrar.datosBancarios.productora', 'uses' => 'ProductoraController@mostrarDatosBancarios']);
            Route::post('/', ['as' => 'crear.datosBancarios.productora', 'uses' => 'ProductoraController@crearDatosBancarios']);
            Route::put('/', ['as' => 'actualizar.datosBancarios.productora', 'uses' => 'ProductoraController@actualizarDatosBancarios']);
            Route::put('/pin', ['as' => 'pin-actualizar.datosBancarios.productora', 'uses' => 'ProductoraController@actualizarPin']);
            Route::delete('/', ['as' => 'eliminar.datosBancarios.productora', 'uses' => 'ProductoraController@eliminarDatosBancarios']);
        });

        #Ventas
        Route::group(['prefix' => 'ventas'], function() {
            Route::get('/',  ['as' => 'mostrar.ventas.productora', 'uses' => 'VentasController@showAllVentas']);
            Route::get('/{id}/',  ['as' => 'mostrar.ventas.productora', 'uses' => 'VentasController@showVenta']);
        });

        #Filtros
        Route::group(['prefix' => 'filtro'], function() {
            Route::get('/mediosdepago',  ['as' => 'mostrar-medios.filtro.productora', 'uses' => 'ProductoraController@showMediosDePago']);
            Route::get('/{id}/distancias',  ['as' => 'mostrar-distancias.filtro.productora', 'uses' => 'ProductoraController@showDistancias']);
            Route::get('/{id}/competencias',  ['as' => 'mostrar-competencias.filtro.productora', 'uses' => 'ProductoraController@showCompetencias']);
            Route::get('/fechas',  ['as' => 'mostrar-fechas.filtro.productora', 'uses' => 'ProductoraController@showFechas']);
            Route::get('/paises',  ['as' => 'listado-paises.filtro.productora', 'uses' => 'ProductoraController@getPaises']);
            Route::get('/provincias',  ['as' => 'listado-paises.filtro.productora', 'uses' => 'ProductoraController@getProvincias']);
        });

    });
});

