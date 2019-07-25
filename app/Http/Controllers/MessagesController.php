<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateMessageRequest;
use App\Message;
use Illuminate\Mail\Message as IlluminateMessage;

class MessagesController extends Controller
{
    
    public function show(Message $message){

        //Poner el Message $message en la funcion es similar que poner esta linea pero dejarlo como parametro al final nos servira para decirle a laravel que si no encuentra ese objeto en la base de datos muestre el error 404
        //$message = Message::find($message);


        //escribir messages.show, el punto es una covencion que indica que existe una carpeta messages, con una vista show.blade.php.
        return view('messages.show', [
            'message'=>$message,
        ]);
    }

    public function create(CreateMessageRequest $request){


        $user = $request->user();

       $message = Message::create([
           //El key es el nombre de la columna en la base de datos
           'content'=>$request->input('message'),
           'image'=>'http://lorempixel.com/600/388?1'.mt_rand(0,1000),
           'user_id'=> $user->id
       ]);

       return redirect('/messages/'.$message->id);
    }
}
