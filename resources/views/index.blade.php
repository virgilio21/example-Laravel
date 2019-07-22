@extends('layouts.app')
<!-- La primera instrucion es siempre extender el layout, en este caso es el layout app. -->

@section('content')
    <div class="title m-b-md">
        Laratter
    </div>

    @if (@isset($teacher))
        <p>{{$teacher}}</p>
    @else
        <p>Profesor a definir</p>
    @endif

    <div class="links">

        @foreach ( $links as $link => $text )
            <a href="{{$link}}"> {{$text}}</a>
        @endforeach
        
    </div>
@endsection

