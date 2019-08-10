@extends('layouts.app')


@section('content')
    <!--Creamos un h1 con los involucrados en la conversacion excepto el usuario logueado
    obtenemos todos los usuarios y quitamos en usuario logueado, luego obtenemos y concatenamos los nombres de los usuarios separandolos con ',' .
    -->
    <h1>Conversacion con {{ $conversation->users->except($user->id)->implode('name',',')}}</h1>


    @foreach ($conversation->privateMessages as $message)

        <div class="card">

            <div class="card-header">
                {{$message->user->name}} dijo ...
            </div>

            <div class="card-block p-2">
                {{$message->message}}
            </div>

            <div class="card-footer">
                {{$message->created_at}}
            </div>


        </div>
        
    @endforeach
@endsection