@extends('layouts.app')

@section('content')
	<form method="POST" action="/articles" class="row main-form" enctype="multipart/form-data">
		{!! csrf_field() !!}
	    @include('articles.form', compact('submitButtonText', 'categories', 'tags'))
    <form>
@endsection