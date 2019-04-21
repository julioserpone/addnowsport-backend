<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Cuando todas las rutas esten establecidas se incorporan aca correctamente, mientras para evitar conflictos con este archivo de uso grupal
//require __DIR__ . '/developers/gary.php';
//require __DIR__ . '/developers/julio.php';
//require __DIR__ . '/developers/raffaele.php';
//require __DIR__ . '/developers/reysmer.php';

Route::get('/paises',  ['as' => 'listado', 'uses' => 'ProductoraController@getPaises']);

Route::group(['middleware' => ['cors'], 'prefix' => 'v1'], function() {

    require __DIR__ . '/autenticacion.php';
    require __DIR__ . '/prefix/system.php';
    require __DIR__ . '/prefix/administradora.php';
    require __DIR__ . '/prefix/productora.php';
    require __DIR__ . '/prefix/usuario.php';

    #Rutas para los cambios de Usuario a Rol
    Route::group(['prefix' => 'cambiar'], function() {
        Route::post('/administrador', ['as' => 'administrador.cambiar.usuario', 'uses' => 'GeneralController@cambiarRolAdministrador']);
        Route::post('/soporte', ['as' => 'soporte.cambiar.usuario', 'uses' => 'GeneralController@cambiarRolSoporte']);
        Route::post('/productora', ['as' => 'productora.cambiar.usuario', 'uses' => 'GeneralController@cambiarRolProductora']);
        Route::post('/usuario', ['as' => 'productora.cambiar.usuario', 'uses' => 'GeneralController@cambiarRolUsuario']);
    });

    #Filtros
    Route::group(['prefix' => 'filtro'], function() {
        Route::get('/fechas',  ['as' => 'mostrar-fechas.filtro.productora', 'uses' => 'GeneralController@mostrarFechas']);
        Route::get('/paises',  ['as' => 'listado-paises.filtro.productora', 'uses' => 'GeneralController@mostrarPaises']);
        Route::get('/provincias',  ['as' => 'listado-paises.filtro.productora', 'uses' => 'GeneralController@mostrarProvincias']);
    });

});
