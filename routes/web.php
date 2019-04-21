<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

Route::get('migrate', 'CommandsController@migrate');
Route::get('rollbackall', 'CommandsController@rollBackAll');
Route::get('rollbackonestep', 'CommandsController@rollBackOneStep');
Route::get('seed', 'CommandsController@seeder');
Route::get('all', 'CommandsController@all');

/* * *************************Rutas Publicas**************************************************** */
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::post('/webpay-transicion', ['as' => 'webpay.transicion',
    'uses' => 'WebPayController@postWebPayTransicion']);
Route::post('/webpay-final', ['as' => 'webpay.final',
    'uses' => 'WebPayController@postWebPayFinal']);

# Social Authentication Routes
Route::get('social/{provider?}', 'SocialAuthController@getSocialAuth');
Route::get('social/callback/{provider?}', 'SocialAuthController@getSocialAuthCallback');

/* * *************************Rutas Privadas*************************************************** */
# Autenticación
Route::auth();
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::get('activate/{id}/{code}', ['as' => 'activacion.usuario', 'uses' => 'Auth\RegisterController@activarUsuario']);
Route::get('reactivate', ['as' => 'reactivacion.usuario', 'uses' => 'Auth\LoginController@reactivacionCuenta']);

/* Route::group(['roles' => ['productora'], 'middleware' => ['roles']], function() {

  Route::get('productora/nueva-competencia',
  ['as' => 'productora/competencia_crear',
  'uses' => 'ProductoraController@nuevaCompetencia']);

  Route::get('productora/ver-perfil',
  ['as' => 'productora/ver-perfil',
  'uses' => 'ProductoraController@productoraCrear']);
  Route::post('productora/wizard/{step}', ['as' => '/productora/wizard', 'uses' => 'ProductoraController@wizard']);
  Route::get('productora/dependencias-wizard/{productora_id}',
  ['as' => 'productora/dependencias-wizard',
  'uses' => 'ProductoraController@obtenerDependenciasWizard']);
  Route::post('productora/logo',
  ['as' => 'productora/logo',
  'uses' => 'ProductoraController@logo']);
  }); */
# Chat
Route::get('chat', ['as' => 'chat', 'uses' => 'ChatController@getChat']);
Route::post('sendmessage', ['as' => 'sendmessage', 'uses' => 'ChatController@sendMessage']);
Route::post('changePassword', ['as' => 'changePassword', 'uses' => 'HomeController@changePassword']);

/*$Routes = function() {
    Route::group(['prefix' => 'administrador', 'roles' => ['administrador'], 'middleware' => ['roles']], function() {
        Route::get('', ['as' => '', 'uses' => 'AdministradorController@index']);
        Route::get('/index', ['as' => 'administrador/index', 'uses' => 'AdministradorController@index']);
        Route::get('/panel', ['as' => 'administrador/panel', 'uses' => 'AdministradorController@index']);
        Route::post('/disciplina', ['as' => '/administrador/disciplina', 'uses' => 'AdministradorController@nuevaDisciplina']);
        Route::get('/usuarios', ['as' => 'administrador/usuarios', 'uses' => 'AdministradorController@listaUsuarios']);

        Route::get('/productoras', ['as' => 'administrador/productoras', 'uses' => 'AdministradorController@productoras']);
        Route::post('/nueva-productora', ['as' => '/administrador/nueva-productora', 'uses' => 'AdministradorController@nuevaProductora']);
        Route::get('/modificar-productora', ['as' => 'administrador/modificar-productora', 'uses' => 'AdministradorController@modificarProductora']);
        Route::get('/eliminar-productora', ['as' => 'administrador/eliminar-productora', 'uses' => 'AdministradorController@eliminarProductora']);
        Route::get('/balance', ['as' => 'administrador/balance', 'uses' => 'AdministradorController@balance']);
        Route::get('/ventas', ['as' => 'administrador/ventas', 'uses' => 'AdministradorController@ventas']);
        Route::get('/transferir', ['as' => 'administrador/transferir', 'uses' => 'AdministradorController@transferir']);
        Route::get('/inscriptos', ['as' => 'administrador/inscriptos', 'uses' => 'AdministradorController@inscriptos']);
        Route::get('codigo', ['as' => 'administrar.codigos', 'uses' => 'CodigoController@index']);
        Route::get('/mailing', ['as' => 'administrador/mailing', 'uses' => 'AdministradorController@getMailing']);
        Route::post('/mailing', ['as' => 'administrador/mailing', 'uses' => 'AdministradorController@postMailing']);
        Route::get('/asistente', ['as' => 'administrador/asistente', 'uses' => 'AdministradorController@asistente']);
        Route::get('/productoraWizard', ['as' => '/administrador/productoraWizard', 'uses' => 'AdministradorController@productoraWizard']);
    });

    Route::group(['prefix' => 'soporte', 'roles' => ['soporte'], 'middleware' => ['roles']], function() {
        Route::get('', ['as' => '', 'uses' => 'SoporteController@index']);
        Route::get('/', ['as' => '/', 'uses' => 'SoporteController@index']);
        Route::group(['prefix' => 'perfil'], function() {
            Route::get('/', ['as' => 'soporte/perfil', 'uses' => 'SoporteController@perfil']);
            Route::post('/edit', ['as' => '/soporte/perfil/edit', 'uses' => 'SoporteController@ActualizarPerfil']);
        });

        Route::get('/cambiar-clave', ['as' => 'soporte/changePassword', 'uses' => 'SoporteController@changePassword']);
        Route::get('/MisInscripciones', ['as' => 'soporte/misinscripciones', 'uses' => 'SoporteController@misinscripciones']);
    });

    Route::group(['prefix' => 'productora', 'roles' => ['productora'], 'middleware' => ['roles']], function() {
        Route::get('/', ['as' => 'productora', 'uses' => 'ProductoraController@index']);
        Route::post('/', ['as' => '/productora', 'uses' => 'ProductoraController@index']);
        Route::group(['prefix' => 'perfil'], function() {
            Route::get('/', ['as' => 'productora/perfil', 'uses' => 'ProductoraController@perfil']);
            Route::post('/edit', ['as' => '/productora/perfil/edit', 'uses' => 'ProductoraController@ActualizarPerfil']);
        });

        Route::get('/datos-bancarios', ['as' => 'productora/datos-bancarios', 'uses' => 'ProductoraController@datosBancarios']);
        Route::get('/pin', ['as' => 'productora/pin', 'uses' => 'ProductoraController@pin']);
        //Route::get('/nueva-competencia', ['as' => 'productora/nueva-competencia', 'uses' => 'ProductoraController@nuevaCompetencia']);
        Route::get('/mis-competencias', ['as' => 'productora/mis-competencias', 'uses' => 'ProductoraController@misCompetencias']);
        Route::get('/lista-inscriptos', ['as' => 'productora/lista-inscriptos', 'uses' => 'ProductoraController@listaInscriptos']);
        Route::get('/codigo', ['as' => 'productora/codigo', 'uses' => 'ProductoraController@codigo']);
        Route::get('/cargar-tiempo', ['as' => 'productora/cargar-tiempo', 'uses' => 'ProductoraController@cargarTiempo']);
        Route::get('/generar-categoria', ['as' => 'productora/generar-categoria', 'uses' => 'ProductoraController@generarCategoria']);
        Route::get('/tablas-de-puntos', ['as' => 'productora/tablas-de-puntos', 'uses' => 'ProductoraController@tablas']);
        Route::get('/resultados', ['as' => 'productora/resultados', 'uses' => 'ProductoraController@resultados']);
        Route::get('/ventas-realizadas', ['as' => 'productora/ventas-realizadas', 'uses' => 'ProductoraController@ventasRealizadas']);
        Route::get('/retirar-fondos', ['as' => 'productora/retirar-fondos', 'uses' => 'ProductoraController@retirarFondos']);
        Route::get('/alertas', ['as' => 'productora/alertas', 'uses' => 'ProductoraController@alertas']);
        Route::get('/mensajes', ['as' => 'productora/mensajes', 'uses' => 'ProductoraController@mensajes']);
    });

    Route::group(['prefix' => 'usuario', 'roles' => ['usuario'], 'middleware' => ['roles']], function() {
        Route::get('/', ['as' => 'usuario', 'uses' => 'UsuarioController@index']);
        Route::post('/', ['as' => '/usuario', 'uses' => 'UsuarioController@index']);
        Route::group(['prefix' => 'perfil'], function() {
            Route::get('/', ['as' => 'usuario/perfil', 'uses' => 'UsuarioController@perfil']);
            Route::post('/edit', ['as' => '/usuario/perfil/edit', 'uses' => 'UsuarioController@ActualizarPerfil']);
            Route::post('/actualizarFoto', ['as' => '/usuario/perfil/actualizarFoto', 'uses' => 'UsuarioController@actualizarFoto']);
        });

        Route::get('/cambiar-clave', ['as' => 'usuario/changePassword', 'uses' => 'UsuarioController@changePassword']);
        Route::get('/MisInscripciones', ['as' => 'usuario/misinscripciones', 'uses' => 'UsuarioController@misinscripciones']);
    });
};

Route::group(array('domain' => env('APP_DOMAIN')), $Routes);
*/
//Route::group(array('domain' => 'test.addnowsport'), $Routes);
