<?php

Route::group(['middleware' => ['cors'], 'prefix' => 'v1'], function() {

    #VALORES LISTA (PARA DROPDOWNS)
    #Estos valores listas requieren de una autenticacion. Si no se reciben un token valido, el core rechaza la peticion
    Route::group(['prefix' => 'productora', 'middleware' => ['jwt.verifytoken','jwt.auth']], function() {

        #Perfil Productora
        Route::group(['prefix' => 'perfil'], function() {
            Route::put('/', ['as' => 'actualizar.perfil.productora', 'uses' => 'ProductoraController@actualizarProductora']);
        });

        #Datos Bancarios
        Route::group(['prefix' => 'datosbancarios'], function() {
            Route::post('/', ['as' => 'crear.datosBancarios.productora', 'uses' => 'ProductoraController@crearDatosBancarios']);
            Route::put('/', ['as' => 'actualizar.datosBancarios.productora', 'uses' => 'ProductoraController@actualizarDatosBancarios']);
            Route::delete('/{id}', ['as' => 'eliminar.codigos.system', 'uses' => 'ProductoraController@eliminarDatosBancarios']);
            Route::get('/', ['as' => 'mostrar.datosBancarios.productora', 'uses' => 'ProductoraController@mostrarDatosBancarios']);
        });

    });

    #Rutas Administrativas
    Route::group(['prefix' => 'system'], function() {

        Route::group(['roles' => ['system'], 'middleware' => ['jwt.verifytoken','jwt.auth','roles']], function() {

            #Administracion de Usuarios
            Route::group(['prefix' => 'productora'], function() {
                Route::post('/{usuario_id}', ['as' => 'crear.productora.administrador', 'uses' => 'AdministradorController@crearProductora']);
            });

        });
    });

});
