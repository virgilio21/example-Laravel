@extends('layouts.app')


@section('content')
<h1>{{$user->username}}</h1> 
<a href="/{{$user->username}}/follows" class="btn btn-link">Sigue a <span class="badge badge-default">{{$user->follows->count()}}</span></a>

<a href="/{{$user->username}}/followers" class="btn btn-link">Seguidores <span class="badge badge-default">{{$user->followers->count()}}</span></a>

@if(Auth::check())

    <!--Llave y usuario al que le queremos pasar el mensaje privado, en este caso esta guardado en la variable user.-->
    @if(Gate::allows('dms', $user))
    <form action="/{{ $user->username}}/dms" method="POST" class="mb-2">
        {{csrf_field()}}
        <input type="text" name="message" class="form-control mb-1">
        <button class="btn btn-dark">
            Enviar DM
        </button>
    </form>

    @endif


    @if(Auth::user()->isFollowing($user))

        <form action="/{{$user->username}}/unfollow" method="POST">
            {{csrf_field()}}
            <!--Util para saber la respuesta de un pedido-->
            @if(session('success'))
                <span class="text-succes">{{session('success')}}</span>
            @endif
            <button class="btn btn-danger">
                Unfollow
            </button>
        </form>

    @else
        <form action="/{{$user->username}}/follow" method="POST">
            {{csrf_field()}}
            <!--Util para saber la respuesta de un pedido-->
            @if(session('success'))
                <span class="text-succes">{{session('success')}}</span>
            @endif
            <button class="btn btn-primary">
                Follow
            </button>
        </form>
    @endif
    
@endif
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