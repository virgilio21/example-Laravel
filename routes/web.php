<?php
use Illuminate\Support\Facades\Route;

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


//Ruta para crear pagina con un message particular resiviendo el id, detaller del mensaje.
Route::get('/messages/{message}', 'MessagesController@show');

//Ruta que crea el mensaje
//Necesitamos un middleware que nos permita proteger esta ruta para que solo usuarios logueados la puedan usar. Para eso usamos el middleware auth.
Route::post('/messages/create', 'MessagesController@create')->middleware('auth');

//Rutas de autenticacion
Auth::routes();
//Rutas facebook
Route::get('/auth/facebook', 'SocialAuthController@facebook');
Route::get('/auth/facebook/callback', 'SocialAuthController@callback');
//Ruta para registrar en facebook
Route::post('/auth/facebook/register', 'SocialAuthController@register');


//Ruta para ver los mensajes del usuario
Route::get('/{username}', 'UsersController@show');

//Ruta para ver usuarios que sigues
Route::get('/{username}/follows', 'UsersController@follows');


//Ruta para ver quienes te siguen.
Route::get('/{username}/followers', 'UsersController@followers');


//Agrupar rutas para definir prefigos o middlewers para usar en esas rutas

Route::group(['middleware' => 'auth'], function(){

    //Ruta para seguir a un usuario
    Route::post('/{username}/follow', 'UsersController@follow');

    //Ruta para dejar de seguir a un usuario
    Route::post('/{username}/unfollow','UsersController@unFollow');

    Route::post('/{username}/dms','UsersController@sendPrivateMessage');

    //Ruta para ver la conversacion pasandole el conversation id.
    Route::get('/conversations/{conversation}', 'UsersController@showConversation');


});