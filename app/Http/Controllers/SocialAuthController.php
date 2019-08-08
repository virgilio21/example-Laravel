<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class SocialAuthController extends Controller
{
    //

    public function facebook(){

        return Socialite::driver('facebook')->redirect();
    }

    public function callback(){

        $user = Socialite::driver('facebook')->stateless()->user();

        /* Yo también estuve enfrascado en este error y gracias al aporte pase el error y consulte el caso, se da porque esta habilitado la verificación del estado de la sesión, al usar el método se deshabilita la verificación.*/
        dd($user);
    }
}
