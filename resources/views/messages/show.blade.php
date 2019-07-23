@extends('layouts.app')
<!--Busca en la carpeta layouts la vista app.-->

@section('title')
    Detalles del mensaje
@endsection

@section('content')
    <div class="row">

        <div class="col-12">
            
            <p class="card-text">id:{{$message->id}}</p>
            <img class="img-thumbnail" src="{{$message->image}}" alt="Imagen ramdom">
            <p class="card-text">{{$message->content}}</p>
            <small>{{$message->created_at}}</small>
        </div>
    </div>   
@endsection