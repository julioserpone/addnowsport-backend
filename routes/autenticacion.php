<?php


	#Autenticación y Registro
	Route::post('authenticate', ['as' => 'usuario.login', 'uses' => 'Auth\LoginController@authenticate']);
	Route::post('register', ['as' => 'usuario.registro', 'uses' => 'Auth\RegisterController@register']);
	Route::get('logout', ['as' => 'usuario.logout', 'uses' => 'Auth\LoginController@finish']);
	Route::get('activate/{id}/{code}', ['as' => 'usuario.activacion', 'uses' => 'Auth\RegisterController@activarUsuario']);
	Route::get('reactivate', ['as' => 'usuario.reactivacion', 'uses' => 'Auth\LoginController@reactivacionCuenta']);

	#Social Authentication Routes
	Route::get('social/{provider?}', 'SocialAuthController@getSocialAuth');
	Route::get('social/callback/{provider?}', 'SocialAuthController@getSocialAuthCallback');

	#requiere que se suministre token via URL. Ejemplo: http://api.psp.app/ruta?token={token} ó se asigna al header que se envia por angular
	Route::get('data/token', ['as' => 'data.usuario.autenticado', 'uses' => 'UsuarioController@getUsuarioAutenticado']);
