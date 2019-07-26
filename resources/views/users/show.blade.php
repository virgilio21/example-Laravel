@extends('layouts.app')


@section('content')
<h1>{{$user->username}}</h1> 

<div class="row">
    
        <!--Declaramos una funcion en el modelo de User que nos permite hacer esta operacion de traer todos los mensajes de un usuario, llamando a la funcion messages
        OJO las funciones no llevan el $, por que no son variables
        -->
        @foreach ($user->messages as $message)
        <div class="col-6">
            @include('messages.message') 
        </div>   
        @endforeach
    
</div>
@endsection