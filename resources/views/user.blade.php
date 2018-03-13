@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-3">
           @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
             
            <div class="card">
              <img class="card-img-top" src="http://placeimg.com/300/300/people?{{random_int(1, 1000)}}" alt="Card image cap">
              <div class="card-header">  
                 {{$user->nombre}}
                @if (Auth::check() && Auth::user()->id != $user->id )
                  @if (Auth::user()->isFriend($user))
                    <form action="/user/{{$user->id}}/friends" method="post" />
                      @csrf
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-danger float-right">Eliminar</button> 
                   </form>
                  @else
                     <form action="/user/{{$user->id}}/friends" method="post">
                      @csrf
                      <button type="submit" class="btn btn-primary float-right">Agregar</button> 
                   </form>
                  @endif
                @endif
                @if (Auth::check() && Auth::user()->id == $user->id )
                  <form action="/user/{{$user->id}}/update" method="get" />
                    @csrf
                    <button type="submit" class="btn btn-primary float-right">Editar</button> 
                 </form>
                @endif

              </div>
                <div class="card-body">
                   <strong>Cedula:</strong> {{$user->cedula}} 
                  <hr>
                  <strong>Correo:</strong> {{$user->email}} 
               </div>
            </div>
           
        </div>
  
        <div class="col">
           @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                  @endif
              @forelse($user->messages as $message)
                    <div class="card mt-1">
                        <div class="card-body">
                            <h5 class="card-title"><a href="/user/{{$message->user_id}}">{{$user->nombre}}</a></h5>
                            <p class="card-text">{{$message['content']}}</p>
                        </div>
                    </div>
                @empty
                    <h3 class="mx-auto">No hay publicaciones que visualizar</h3>
                @endforelse
        </div>
    </div>
</div>
@endsection
