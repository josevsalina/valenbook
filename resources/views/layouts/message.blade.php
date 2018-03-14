
<div class="card mt-1 mb-2">
	  <div class="card-header bg-dark ">
    	<div class="d-flex justify-content-between bd-highlight">
		<ul class="nav nav-pills pull-left">
			<li class="nav-item">
		      	<a class="nav-link text-white" href="/user/{{$message->user_id}}">{{$message->user->nombre}}</a>
		    </li>
	    </ul>
	     @if (Auth::check() && Auth::user()->id == $message->user_id )
	    <ul class="nav nav-pills card-header-pills pull-right">
			<li class="nav-item">
				<form id="editar-msj" action="/user/{$message->user_id}/message/{$message->id}" method="post" />
	                @csrf
	                <input type="hidden" name="_method" value="PUT">
					<a class="nav-link text-primary	"  href="#">Editar</a>	    		
				</form>
		      	
		    </li>
	        <li class="nav-item active">
	        	<form id="borrar-msj" action="/messages/{{$message->id}}" method="post" />
	                @csrf
	                <input type="hidden" name="_method" value="DELETE">
					<a class="nav-link text-danger	" onclick="document.getElementById('borrar-msj').submit()" href="#">Borrar</a>	    		
				</form>
	        </li>
        </ul>
        @endif
    </div>
</div>	
    <div class="card-body">
	        <p class="card-text">{{$message['content']}}</p>
	        <span>{{$message['updated_at']}}</span>
    </div>
</div>