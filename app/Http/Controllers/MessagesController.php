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
        //Cuando son archivos en el input no se usa el metodo input, en vez de eso usamos file.
        $image = $request->file('image');

       $message = Message::create([
           //El key es el nombre de la columna en la base de datos
           'content' => $request->input('message'),
           //Hay que guardar la imagen en algun lugar en este caso en una carpetas messages dentro de storage public, para eso se usa el comando php artisan storage:link para vincular la carpeta storage public a la carptea public, es un link sombolico :D.
           //Nos devuelve un nombre al azar para emitar nombres repetidos.
           'image' => $image->store('messages', 'public'),
           'user_id' => $user->id
       ]);

       return redirect('/messages/'.$message->id);
    }

    public function search( Request $request ){

        $query = $request->input('query');

        //Le doy el nombre de la columna el operador en este caso like, lo que busco es que el contenido que me trae el request este en algun mensaje aunque no sea el contenido completo y por el ultimo el valor que va a buscar.

        //Sin Laravel Scout
        /*$messages = Message::with('user')->where( 'content', 'LIKE', "%$query%" )->get();*/


        //Esto traera mas de un mensaje si se encuentran

        //Con Laravel Scout
        //get() trae todas las coincidencias
        $messages = Message::search($query)->get();

        $messages->load('user');

        return view('messages.index', [
            'messages' => $messages
        ]);
            
        //Usando with agilisamos la query, pasamos de cientas de consultas a tan solo dos,
        //Agilizamos la traida de datos del usuario ya que nos servira para la vista.



        //el with es cuando armas una query
        //Y el load cuando ya tienes una query ejecutada
    }
}
