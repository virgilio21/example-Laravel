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
}
