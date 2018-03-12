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
            <div class="card-header">   {{$user->nombre}}  </div>
              <div class="card-body">
                 {{$user->cedula}} 
                  {{$user->email}} 
             </div>
            </div>
           
        </div>
  
        <div class="col">
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
