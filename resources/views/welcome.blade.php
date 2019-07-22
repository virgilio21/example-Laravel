

@extends('layouts.app')
<!-- La primera instrucion es siempre extender el layout, en este caso es el layout app. -->

@section('content')
    
    <div class="jumbotron text-center">
        <h1>Laratter</h1>

        <nav>
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>
                <!--<li class="nav-item"><a class="nav-link" href="/about">Acerca</a></li>-->
            </ul>
        </nav>
    </div>

    <div class="row">

        
        <!--Un else foreach es como un if else, el forelse es if y el emply es else
        !!!!La primera parte se ejecuta si el array tiene datos y por conseguiente el emply se ejecuta si no hay datos en el arreglo
        -->
        @forelse ($messages as $message)
            <div class="col-6">
                
                <img  class="img-thumbnail" src="{{$message['image']}}" alt="imagen ramdon o eso parece">
                <p class="card-text">{{$message['content']}} <a href="/messages/{{$message['id']}}">Ver maś</a>
                </p>
                

            </div>
        @empty
            <p>No hay nuevos mensajes</p>
            
        @endforelse

            

        
     
        
    </div>
@endsection