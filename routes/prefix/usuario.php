<?php

#Rutas perfil USUARIO

Route::group(['prefix' => 'usuario'], function() {

    Route::group(['roles' => ['usuario'], 'middleware' => ['jwt.verifytoken', 'jwt.auth', 'roles']], function() {

        #Perfil Usuario
        Route::group(['prefix' => 'perfil'], function() {
            Route::get('/', ['as' => 'mostrar.perfil.usuario', 'uses' => 'UsuarioController@mostrarPerfil']);
            Route::get('/mis-inscripciones', ['as' => 'inscripciones.perfil.usuario', 'uses' => 'UsuarioController@misInscripciones']);
            Route::get('/mis-resultados', ['as' => 'resultados.perfil.usuario', 'uses' => 'UsuarioController@misResultados']);
            Route::put('/actualizar-datos', ['as' => 'actualizar.perfil.usuario', 'uses' => 'UsuarioController@actualizarDatos']);
            Route::put('/cambiar-clave', ['as' => 'cambiar-clave.perfil.usuario', 'uses' => 'UsuarioController@cambiarClave']);
        });

        #Gestion de Inscripciones
        Route::group(['prefix' => 'inscripciones'], function() {
            Route::get('/competencia/{id}', ['as' => 'registro.inscripcion.usuario', 'uses' => 'InscriptoController@create']);
            Route::post('/aplicar/{codigo}', ['as' => 'aplicar.codigo.inscripcion.usuario', 'uses' => 'CodigoController@aplicarCodigo']);
            Route::post('/', ['as' => 'registrar.inscripcion', 'uses' => 'InscriptoController@store']);
            Route::put('/{id}', ['as' => 'actualizar.inscripcion', 'uses' => 'InscriptoController@update']);
        });

        #Gestion de Webpay
        Route::group(['prefix' => 'webpay'], function() {
            Route::post('/init-transaction', ['as' => 'webpay.init.transaction', 'uses' => 'WebPayController@initTransaction']);
            Route::post('/get-transaction-result', ['as' => 'webpay.transaction.result', 'uses' => 'WebPayController@getTransactionResult']);
            Route::post('/acknowledge-transaction', ['as' => 'webpay.acknowledge.transaction', 'uses' => 'WebPayController@acknowledgeTransaction']);
        });

        Route::get('/', ['as' => 'usuario', 'uses' => 'UsuarioController@index']);

    });
});
