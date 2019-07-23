

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


        <form action="/messages/create" method="POST">
            
            <!--La line incrustada en el atributo class no se por que no funciona-->
            <div class="form-group @if ($errors->has('message')) has-danger @endif ">
                <!--Sirve para validar que este formulario es nuestro, nos protegemos del tipo de error o de ataque de csrf, osea que otra web envie un formulario hacia nuestra pagina-->
                {{ csrf_field() }}
                <input class="form-control" type="text" name="message" placeholder="¿Que estas pensando?">

                <!--Si encuentra un error relacionado con el campo message lo guarda en errors-->
                @if( $errors->has('message'))

                    <!--Obtiene los errores asociados a message, iterando-->
                    @foreach ($errors->get('message') as $error)
                        <div class="form-control-feedback" >{{$error}}</div>    
                    @endforeach
                @endif
            </div>
        
        </form>
    </div>

    <div class="row">

        
        <!--Un else foreach es como un if else, el forelse es if y el emply es else
        !!!!La primera parte se ejecuta si el array tiene datos y por conseguiente el emply se ejecuta si no hay datos en el arreglo
        -->
        @forelse ($messages as $message)
            <div class="col-6">
                
                <!--Tambien podemos acceder a estas propiedades como $message['nombrePropiedad']-->
                <img  class="img-thumbnail" src="{{$message['image']}}" alt="imagen ramdon o eso parece">
                <p class="card-text">{{$message['content']}} <a href="/messages/{{$message['id']}}">Ver maś</a>
                </p>
                

            </div>
        @empty
            <p>No hay nuevos mensajes</p>
            
        @endforelse

        <!--Si aun hay mensajes se crearan otras paginas y laravel agregara un parametro a las rutas-->

        @if(count($messages))
            <div class="mt-2 mx-auto">
                {{$messages->links()}}
            </div>
        @endif

            

        
     
        
    </div>
@endsection