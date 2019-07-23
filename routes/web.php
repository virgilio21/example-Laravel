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

Route::post('/messages/create', 'MessagesController@create');

//Rutas de autenticacion
Auth::routes();


