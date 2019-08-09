<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\SocialProfile;
use App\User;


class SocialAuthController extends Controller
{
    //

    public function facebook(){

        return Socialite::driver('facebook')->redirect();
    }

    public function callback(){

        $user = Socialite::driver('facebook')->stateless()->user();

        /* Yo también estuve enfrascado en este error y gracias al aporte pase el error y consulte el caso, se da porque esta habilitado la verificación del estado de la sesión, al usar el método se deshabilita la verificación.*/
        

        //Buscamos en la tabla social profile, un usuario que tenga el social_id que nos regresa facebook y que tenga un user_id asignado
        //El metodo whereHas, resive como primer parametro la relacion en decir el nombre del metodo en la clase user que define la relacion, como segundo parametro una funcion anonima que define la query.
        $existing = User::whereHas('socialProfiles', function($query) use ($user){
            $query->where('social_id', $user->id);
        })->first();

        if( $existing !== null ){
            auth()->login($existing);

            return redirect('/');
        }

        User::whereHas();


        session()->flash('facebookUser', $user);
        //guarda los datos en session hasta que se haga una solicitud mas, estos datos se eliminaran.

        return view('users.facebook',[
            'user' => $user
        ]);
    }

    public function register(Request $request){

        //Traemos de la sesion los datos del usuario
        $data = session('facebookUser');

        //Tremos el username del formulario
        $username = $request->input('username');

        //Creamos el usuario
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'avatar' => $data->avatar,
            'username' => $username,
            'password' => str_random(16),

        ]);

        //Creamos el perfil de redes sociales
        $profile = SocialProfile::create([
            'social_id' => $data->id,
            'user_id' => $user->id,
        ]);

        //Logueamos al usuario y lo redireccionamos a la home
        auth()->login($user);
        return redirect('/');
    }
}
