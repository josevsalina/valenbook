@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col">
           @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            @if (Auth::check() && Auth::user()->id == $message->user_id )
            
                <div class="card mt-1 mb-2">
                    <div class="card-header bg-dark ">
                        <div class="d-flex justify-content-between bd-highlight">
                        <ul class="nav nav-pills pull-left">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="/user/{{$message->user_id}}">{{$message->user->nombre}}</a>
                            </li>
                        </ul>
                        <ul class="nav nav-pills card-header-pills pull-right">
                            <li class="nav-item">
                                    <a class="nav-link text-primary "  onclick="document.getElementById('update-msj').submit()" href="#">Actualizar</a>               
                            </li>
                            
                        </ul>
                       
                        </div>
                    </div>  
                    <div class="card-body">
                        <form id="update-msj" action="/messages/{{$message->id}}" method="post" />
                         @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input class="form-control input-lg @if ($errors->has('content')) is-invalid @endif" name="content" value="{{$message['content']}}" id="content" type="text">
                          </form>
                    </div>
                </div>
          
             @endif
        </div>
    </div>
</div>
@endsection
