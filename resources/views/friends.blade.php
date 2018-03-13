@extends('layouts.app')

@section('content')
@foreach($user->friends as $friend)
	<li>{{ $friend->nombre }}</li>
@endforeach
@endsection