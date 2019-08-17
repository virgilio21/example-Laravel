<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Message extends Model
{
    use Searchable;
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

    public function toSearchableArray()
    {
        //Le cargamos el user al mensaje y luego lo devolvemos con el mensaje.
        //Esta funcion ya esta definida en la clase Searchable de algolia, nosotros la.
        //sobreescribimos.
        $this->load('user');

        return $this->toArray();

        //Despues de implementar este metodo si ya habiamos indexzado los mensajes en algolia toca volver a hacerlo. osea volver a indexarlos.
    }
}
