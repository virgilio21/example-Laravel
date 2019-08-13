<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //Variable que nos sirve para proteger campos, necesario si queremos agregar objetos a la base de datos tener definida esta varible aunque este vacia
    protected $guarded = [];

    public function user(){

        //Le indicamos la relacion de pertenenecia, osea un mensaje pertenece a un usuario. es este caso.
        return $this->belongsTo(User::class);
    }

    //Al nombrar a esta funcion asi interceptamos todos los llamados a la propiedad image de la clase mensaje y ejecutamos el siguiente codigo
    public function getImageAttribute($image){

        // si image no trae nada o empieza con http retornamos solamente el valor simple, quiere decir que es un lorem ipson de imagen
        if( !$image || starts_with($image, 'http')){
            return $image;
        }

        //Si se ejecuta esta linea devolvemos un link de storage quiere decir que es una imagen que subimos
        return \Storage::disk('public')->url($image);
    }
}
