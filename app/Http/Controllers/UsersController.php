<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\PrivateMessage;
use App\Conversation;

class UsersController extends Controller
{
    
    public function show($username){

        //Guardamos el usuario, buscandolo por username, el primer parametro es el nombre de la columna el segundo es el valor de esa columna. Ponemos la funcion first, por que cuando encuentre la primera coincidencia queremos que para, ya que username es un valor unico no debera repetirse

        //Simular una excepcion  asi     throw new \Exception("Simulando un error");
        $user = $this->findByUsername($username);

        return view('users.show', [
            'user' => $user
        ]);

    }

    //Para ver a quienes sigues
    public function follows($username){

        $user = $this->findByUsername($username);

        return view('users.follows',[
            'user'=>$user,
            'follows'=>$user->follows
        ]);
    }

    //Para seguir a alguien
    public function follow($username, Request $request){

        //Buscamos el usuario que queremos seguir
        $user = $this->findByUsername($username);

        //Traemos del request nuestro propio usuario
        $me = $request->user();

        //agregamos a nuestro usuario, el nuevo usuario que vamos a seguir
        $me->follows()->attach($user);

        //Redireccionamos y mostramos el mensaje de usuario seguido si se logro la operacion
        return redirect("/$username")->withSuccess('Usuario seguido');

    }

    //Buscar al usuario por medio de su username
    private function findByUsername($username){

        //Usar first no nos ayuda a contralar la excepcion con un error 404, debemos utilizar firstOrFail();

        //return $user = User::where('username', $username)->first();
        //El metodo failOrFail simpre devuelve un usuario si lo encuentra y si no, devuelve una excepcion del tipo not found 404.
        return $user = User::where('username', $username)->firstOrFail();
 
    }

    //dejar de seguir a alguien
    public function unFollow($username, Request $request){

        //Buscamos el usuario que queremos seguir
        $user = $this->findByUsername($username);

        //Traemos del request nuestro propio usuario
        $me = $request->user();

        //agregamos a nuestro usuario, el nuevo usuario que vamos a seguir
        $me->follows()->detach($user);

        //Redireccionamos y mostramos el mensaje de usuario seguido si se logro la operacion
        return redirect("/$username")->withSuccess('Usuario no seguido');

    }

    //Para ver quienes te siguen
    public function followers($username){

        $user = $this->findByUsername($username);

        return view('users.follows',[
            'user'=>$user,
            'follows' => $user->followers,
        ]);

    }

    public function sendPrivateMessage( $username, Request $request){

        $user = $this->findByUsername($username);

        $me = $request->user();

        $message = $request->input('message');

        $conversation = Conversation::between($me, $user);

        //Esta parte ya no es necesaria despues de crear el metodo between en conversation.
        /*$conversation = Conversation::create();
        $conversation->users()->attach($me);
        $conversation->users()->attach($user);*/


        $privateMessage = PrivateMessage::create([
            'conversation_id' => $conversation->id,
            'user_id' => $me->id,
            'message' => $message
        ]);

        return redirect('/conversations/'.$conversation->id);

    }

    //Si le pasas el id por la ruta a un funcion Laravel con eloquent convierten ese id en su respectivo objeto
    public function showConversation(Conversation $conversation){

        $conversation->load('users', 'privateMessages');
        
        return view('users.conversation',[
            'conversation' => $conversation,
            'user' => auth()->user(),
        ]);
    }
}
