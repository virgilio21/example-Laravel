<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Rutas para pruebas
Route::get('/', 'PagesController@welcome');


Route::get('/about', 'PagesController@about');


//Rutas laratter
Route::get('/index', 'PagesController@index');


//Ruta para crear pagina con un message particular resiviendo el id.
Route::get('/messages/{message}', 'MessagesController@show');

//Ruta que crea el mensaje
//Necesitamos un middleware que nos permita proteger esta ruta para que solo usuarios logueados la puedan usar. Para eso usamos el middleware auth.
Route::post('/messages/create', 'MessagesController@create')->middleware('auth');

//Rutas de autenticacion
Auth::routes();

//Ruta para ver los mensajes del usuario
Route::get('/{username}', 'UsersController@show');


