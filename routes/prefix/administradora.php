<?php

Route::group(['middleware' => ['cors']], function() {

	#Rutas Administrativas
	Route::group(['prefix' => 'administradora'], function() {

		#Rutas con permisos para administrador y Productoras
		Route::group(['roles' => ['administradora','productora'], 'middleware' => ['jwt.verifytoken','jwt.auth','roles']], function() {

			#Codigos
			Route::group(['prefix' => 'codigos'], function() {
				Route::get('/', ['as' => 'grid.codigos.administradora', 'uses' => 'CodigoController@index']);
				Route::get('search', ['as' => 'buscar.codigos.administradora', 'uses' => 'CodigoController@search']);
				Route::get('/{id}', ['as' => 'mostrar.codigo.administradora', 'uses' => 'CodigoController@show']);
				Route::get('/{id}/estatus/{estatus}', ['as' => 'estatus.codigos.administradora', 'uses' => 'CodigoController@cambiarEstatus']);
				Route::post('/', ['as' => 'guardar.codigos.administradora', 'uses' => 'CodigoController@store']);
				Route::put('/{id}', ['as' => 'actualizar.codigos.administradora', 'uses' => 'CodigoController@update']);
				Route::delete('/{id}', ['as' => 'eliminar.codigos.administradora', 'uses' => 'CodigoController@destroy']);
			});

			Route::group(['prefix' => 'premios'], function() {
				Route::get('/', ['as' => 'todos.premios.administradora', 'uses' => 'PremiosController@mostrarPremios']);
				Route::get('/{id}', ['as' => 'mostrar.premios.administradora', 'uses' => 'PremiosController@mostrarPremio']);
				Route::post('/', ['as' => 'crear.premios.administradora', 'uses' => 'PremiosController@crearPremio']);
				Route::post('/fotos', ['as' => 'agregar.premios.administradora', 'uses' => 'PremiosController@agregarFoto']);
				Route::put('/{id}', ['as' => 'actualizar.premios.administradora', 'uses' => 'PremiosController@actualizarPremio']);
				Route::delete('/{id}', ['as' => 'eliminar.premios.administradora', 'uses' => 'PremiosController@eliminarPremio']);
			});

			Route::group(['prefix' => 'transferencias'], function() {
				Route::get('/', ['as' => 'todos.transferencias.administradora', 'uses' => 'TransferenciasController@mostrarTransferencias']);
				Route::get('/{id}', ['as' => 'mostrar.transferencias.administradora', 'uses' => 'TransferenciasController@mostrarTransferencia']);
				Route::post('/', ['as' => 'crear.transferencias.administradora', 'uses' => 'TransferenciasController@crearTransferencia']);
				Route::post('/{id}', ['as' => 'actualizar.transferencias.administradora', 'uses' => 'TransferenciasController@actualizarTransferencia']);
				Route::delete('/{id}', ['as' => 'eliminar.transferencias.administradora', 'uses' => 'TransferenciasController@eliminarTransferencia']);
			});

		});
                
                Route::group(['roles' => ['administradora'],
                    'middleware' => ['jwt.verifytoken','jwt.auth','roles']], function() {
                    Route::put('/confirmar-datos', ['as' => 'confimar.datos.administradora', 'uses' => 'AdministradorController@validarDatosBancarios']);
                });
	});
});