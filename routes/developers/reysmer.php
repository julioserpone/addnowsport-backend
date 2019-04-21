<?php

#Rutas perfil PRODUCTORA 
Route::group(['middleware' => ['cors'], 'prefix' => 'v1'], function() {

    Route::group(['prefix' => 'productora', 'roles' => ['productora'],
        'middleware' => ['jwt.verifytoken', 'jwt.auth', 'roles']], function() {

        Route::group(['prefix' => 'categorias'], function() {
            Route::post('/', 'CategoriasController@crearCategoria');
            Route::get('/', 'CategoriasController@mostrarCategorias');
            Route::get('/{categoria_id}', 'CategoriasController@mostrarCategoria');
            Route::delete('/{categoria_id}', 'CategoriasController@eliminarCategoria');
            Route::put('/{categoria_id}', 'CategoriasController@actualizarCategoria');
        });

        Route::group(['prefix' => 'grupo-categorias'], function() {
            Route::post('/', 'CategoriasController@crearGrupoCategoria');
            Route::get('/', 'CategoriasController@mostrarTodosGrupoCategoria');
            Route::get('/{grupo_id}', 'CategoriasController@mostrarGrupoCategoria');
            Route::delete('/{grupo_id}', 'CategoriasController@eliminarGrupoCategoria');
            Route::put('/{grupo_id}', 'CategoriasController@modificarGrupoCategoria');
        });

        Route::group([], function() {
            Route::post('/competencias', 'CompetenciasController@crearCompetencia');
            Route::get('/{productora_id}/competencias', 'CompetenciasController@mostrarCompetencias');
            Route::delete('/{productora_id}/competencias', 'CompetenciasController@eliminarCompetencias');
            Route::delete('/{productora_id}/competencias/{competencia_id}', 'CompetenciasController@eliminarCompetencia');
            Route::put('/{productora_id}/competencias/{competencia_id}', 'CompetenciasController@actualizarCompetencia');
            Route::get('/{productora_id}/competencias/{competencia_id}', 'CompetenciasController@mostrarCompetencia');

            Route::group(['prefix' => 'distancias'], function() {
                Route::post('/', 'DistanciasController@crearDistancia');
                Route::get('/', 'DistanciasController@mostrarDistancias');
                Route::get('/{distancia_id}', 'DistanciasController@mostrarDistancia');
                Route::delete('/{distancia_id}', 'DistanciasController@eliminarDistancia');
                Route::put('/{distancia_id}', 'DistanciasController@actualizarDistancia');
            });
        });
    });

    Route::group(['prefix' => 'administradora'], function() {

        #Rutas con permisos para administrador y Productoras
        Route::group(['roles' => ['administradora', 'productora'],
            'middleware' => ['jwt.verifytoken', 'jwt.auth', 'roles']], function() {

            Route::group(['prefix' => 'premios'], function() {
                Route::post('/', 'PremiosController@crearPremio');
                Route::post('/fotos', 'PremiosController@agregarFoto');
                Route::get('/', 'PremiosController@mostrarPremios');
                Route::delete('/{premio_id}', 'PremiosController@eliminarPremio');
                Route::put('/{premio_id}', 'PremiosController@actualizarPremio');
                Route::get('/{premio_id}', 'PremiosController@mostrarPremio');
            });

            Route::group(['prefix' => 'transferencias'], function() {
                Route::post('/', 'TransferenciasController@crearTransferencia');
                Route::get('/', 'TransferenciasController@mostrarTransferencias');
                Route::delete('/{transferencias_id}', 'TransferenciasController@eliminarTransferencia');
                Route::post('/{transferencias_id}', 'TransferenciasController@actualizarTransferencia');
                Route::get('/{transferencias_id}', 'TransferenciasController@mostrarTransferencia');
            });
        });
    });
});
