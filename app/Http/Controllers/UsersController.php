<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    
    public function show($username){

        //Guardamos el usuario, buscandolo por username, el primer parametro es el nombre de la columna el segundo es el valor de esa columna. Ponemos la funcion first, por que cuando encuentre la primera coincidencia queremos que para, ya que username es un valor unico no debera repetirse
        $user = User::where('username', $username)->first();

        return view('users.show', [
            'user' => $user
        ]);

    }
}
