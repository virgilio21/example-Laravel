<!--La parte src de la imagen es necesaria cuando cargamos imagenes que nosotros subimos por un formulario, despues de vincular storage public con la carpeta public-->
<img  class="img-thumbnail" src="{{ $message->image }}" alt="imagen ramdon o eso parece">
<div class="text-muted">Escrito por <a href="{{$message->user->username}}">{{$message->user->username}}<a/></div>    
<p class="card-text">{{$message['content']}} <a href="/messages/{{$message['id']}}">Ver maś</a>
</p>
<div class="text-muted card-text">
    {{$message->created_at}}
</div>