@extends('layouts.app')

@section('content')
    <h1>{{$user->username}}</h1>
    @foreach ($follows as $follow)

    <ul>
        <li>{{$follow->username}}</li>
    </ul>

    @endforeach
@endsection