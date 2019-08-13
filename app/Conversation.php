<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    
    public function users(){

        return $this->belongsToMany(User::class);
    }

    public function privateMessages(){

        return $this->hasMany(PrivateMessage::class)->orderBy('created_at', 'desc');
    }

    //Metodo estatico para crear la conversacion o devolver la conversacion si ya esta creada
    public static function between(User $user, User $otherUser){

        //Primero se comprueba si conversation tiene un modelo relacionado en este caso users, si es haci se hace otra query para saber si el usuario que pasamos como parametro pertenece a esa relacion y volvemos a repetir el proceso con el otro usuario
        $query = Conversation::whereHas('users', function($query) use ($user){
            $query->where('user_id', $user->id);
        })->whereHas('users', function($query) use ($otherUser){
            $query->where('user_id', $otherUser->id);
        });

        //creamos la conversacion si la query falla o retornamos la conversacion existente si la encuentra
        $conversation = $query->firstOrCreate([]);
        //Si se creo la conversacion se creara vacia es decir sin usuarios, es por eso que luego se sincronizan los usuarios por si no existia la conversacion y como no existia se crea vacia, y luego se agregan a los usuarios con el metodo sync

        //Sincronisamos a los usuarios, si no estan en la conversacion los agrega si no pues no hace nada por que ya estaban en la conversacion
        $conversation->users()->sync([
            $user->id, $otherUser->id
        ]);

        return $conversation;

    }
}
