<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    
    public function show($username){

        //Guardamos el usuario, buscandolo por username, el primer parametro es el nombre de la columna el segundo es el valor de esa columna. Ponemos la funcion first, por que cuando encuentre la primera coincidencia queremos que para, ya que username es un valor unico no debera repetirse
        $user = $this->findByUsername($username);

        return view('users.show', [
            'user' => $user
        ]);

    }

    //Para ver a quienes sigues
    public function follows($username){

        $user = $this->findByUsername($username);

        return view('users.follows',[
            'user'=>$user,
            'follows'=>$user->follows
        ]);
    }

    //Para seguir a alguien
    public function follow($username, Request $request){

        //Buscamos el usuario que queremos seguir
        $user = $this->findByUsername($username);

        //Traemos del request nuestro propio usuario
        $me = $request->user();

        //agregamos a nuestro usuario, el nuevo usuario que vamos a seguir
        $me->follows()->attach($user);

        //Redireccionamos y mostramos el mensaje de usuario seguido si se logro la operacion
        return redirect("/$username")->withSuccess('Usuario seguido');

    }

    //Buscar al usuario por medio de su username
    private function findByUsername($username){

        return $user = User::where('username', $username)->first();
    }

    //dejar de seguir a alguien
    public function unFollow($username, Request $request){

        //Buscamos el usuario que queremos seguir
        $user = $this->findByUsername($username);

        //Traemos del request nuestro propio usuario
        $me = $request->user();

        //agregamos a nuestro usuario, el nuevo usuario que vamos a seguir
        $me->follows()->detach($user);

        //Redireccionamos y mostramos el mensaje de usuario seguido si se logro la operacion
        return redirect("/$username")->withSuccess('Usuario no seguido');

    }

    //Para ver quienes te siguen
    public function followers($username){

        $user = $this->findByUsername($username);

        return view('users.follows',[
            'user'=>$user,
            'follows' => $user->followers,
        ]);

    }
}
