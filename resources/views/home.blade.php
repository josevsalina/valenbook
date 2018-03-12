@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form class="form-inline " action="/messages" method="post">
            @csrf
            <div class="col">
                <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0 @if ($errors->has('message')) is-invalid @endif" id="message" name="message" placeholder="¿Qué estás pensando?" >
                @if ($errors->has('message'))
                    <span class="invalid-feedback mb-2 mr-sm-2 mb-sm-0">
                        <strong>{{ $errors->first('message') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col"> <button type="submit" class="btn btn-primary">Publicar</button></div>
        </form>

    </div>


    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
           @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @forelse($messages as $message)
                <div class="card mt-1">
                    <div class="card-body">
                        <h5 class="card-title"><a href="/user/{{$message->user_id}}">{{$message->user->nombre}}</a></h5>
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
