@extends('layouts.app')
<!--Busca en la carpeta layouts la vista app.-->

@section('title')
    Detalles del mensaje
@endsection

@section('content')
    <div class="row">

        <div class="col-12">
            
            <p class="card-text">id:{{$message->id}}</p>
            @include('messages.message')
            <small>{{$message->created_at}}</small>
        </div>
    </div>   
@endsection