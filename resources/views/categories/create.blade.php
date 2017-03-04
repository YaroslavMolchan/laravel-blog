@extends('layouts.app')

@section('content')
	<form method="POST" action="/categories" class="row main-form">
		{!! csrf_field() !!}
	    @include('categories.form')
    <form>
@endsection