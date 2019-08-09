<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialProfile extends Model
{
    //

    protected $guarded =[];


    public function user(){

        //Un Social profile solo pertenece a un usuario
        return $this->belongsTo(User::class);
    }
}
