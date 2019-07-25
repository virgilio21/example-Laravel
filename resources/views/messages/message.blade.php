
<img  class="img-thumbnail" src="{{$message['image']}}" alt="imagen ramdon o eso parece">
<div class="text-muted">Escrito por <a href="{{$message->user->username}}">{{$message->user->username}}<a/></div>    
<p class="card-text">{{$message['content']}} <a href="/messages/{{$message['id']}}">Ver maś</a>
</p>