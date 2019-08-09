@extends('layouts.app')

@section('content')

    <form action="/auth/facebook/register" method="POST">
        {{csrf_field()}}

        <div class="card p-3">
            <div class="card-block">
                <img class="img-thumbnail" src="{{$user->avatar}}" alt="avatar">
            </div>
            <div class="card-block mt-3">

                <div class="form-group">
                    <label for="name" class="form-control-label"> 
                        Nombre
                    </label>
                    <input class="form-control" type="text" name="name" value="{{$user->name}}"readonly>
                </div>

                <div class="form-group">
                        <label for="email" class="form-control-label"> 
                            Email
                        </label>
                        <input class="form-control" type="text" name="email" value="{{$user->email}}"readonly>
                </div>

                
                <div class="form-group">
                        <label for="username" class="form-control-label"> 
                            Username
                        </label>
                        <input class="form-control" type="text" name="username" placeholder="lo que tu quieras" value="{{ old('username')}}">
                </div>

            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">
                    Registrarse
                </button>
            </div>

        </div>
    </form>
@endsection