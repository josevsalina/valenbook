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
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            @forelse($messages as $message)
                @include('layouts.message')
            @empty
                <h3 class="mx-auto">No hay publicaciones que visualizar</h3>
            @endforelse
        </div>
    </div>
</div>
@endsection
