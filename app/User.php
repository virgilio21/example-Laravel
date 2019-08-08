<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'avatar' ,'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function messages(){

        //Le indicamos que muchos mensajes contienen o tienen su id de usuario.
        //Vas a retornar muchos mensajes que contienen tu id, de forma ordenada por fecha de creacion de manera desendente.
        return $this->hasMany(Message::class)->orderBy('created_at','desc');
    }

    public function follows(){

        //A quienes sigo
        return $this->belongsToMany(User::class,'followers','user_id','followed_id');
    }

    public function followers(){
        //Quienes me siguen.
        return $this->belongsToMany(User::class,'followers','followed_id','user_id');
    }

    public function isfollowing(User $user){

        //Le pedimos a los usuarios que seguimos y verificamos si contiene al usuario que vamos a seguir, contains devulve true o false.
        return $this->follows->contains($user);
    }
}
