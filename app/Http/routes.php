<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::get('auth/register/{codigoInstitucion}', 'Auth\AuthController@getGrupos');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('home', 'HomeController@index');
Route::post('home/modificar/{id}', 'UsuarioController@updatePerfil');

//Instituciones
Route::get('instituciones', 'InstitucionController@index');
Route::get('instituciones/ingresar', 'InstitucionController@create');
Route::post('instituciones', 'InstitucionController@store');
Route::post('instituciones/eliminar', 'InstitucionController@destroy');
Route::post('instituciones/modificar/{id}', 'InstitucionController@edit');

//Grupos
Route::get('grupos', 'GrupoController@index');
Route::get('grupos/ingresar', 'GrupoController@create');
Route::post('grupos', 'GrupoController@store');
Route::post('grupos/eliminar', 'GrupoController@destroy');
Route::post('grupos/modificar/{id}', 'GrupoController@edit');

//Usuarios
Route::get('usuarios', 'UsuarioController@index');
Route::get('usuarios/ingresar', 'UsuarioController@create');
Route::get('usuarios/ingresar/{institucion_codigoInstitucion}', 'UsuarioController@getGrupos');
Route::post('usuarios', 'UsuarioController@store');
Route::get('usuarios/{id}', 'UsuarioController@getUsuario');
Route::post('usuarios/modificar/{id}', 'UsuarioController@edit');
Route::post('usuarios/eliminar', 'UsuarioController@destroy');
Route::post('usuarios/test/asignar', 'UsuarioController@asignarTest');

//Solicitudes
Route::get('solicitudes', 'SolicitudController@index');
Route::post('solicitudes/aceptar', 'SolicitudController@store');
Route::post('solicitudes/rechazar', 'SolicitudController@destroy');

//Test
Route::get('test', 'TestController@index');
Route::post('test', 'TestController@store');
Route::get('test/crear', 'TestController@create');
Route::get('test/crear/{codigoPregunta}', 'TestController@getPregunta');
Route::post('test/eliminar', 'TestController@destroy');
Route::post('test/eliminar_pregunta', 'TestController@destroyPregunta');
Route::post('test/modificar/{id}', 'TestController@edit');
Route::get('test/modificar/eliminar_pregunta/{id}', 'TestController@destroyPreguntaModificar');
Route::post('test/cancelar_asignacion', 'TestController@destroyAsignacionTest');
Route::post('test/agregar_comentario/{id}/{codigoTest}', 'TestController@agregarComentario');
Route::get('test/realizar/{codigoTest}', 'TestController@realizarTest');
Route::post('test/realizar', 'TestController@respuestasTest');