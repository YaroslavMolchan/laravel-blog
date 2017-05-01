@extends('layouts.app')

@section('content')
	<form method="POST" action="{!! route('books.store') !!}" class="row main-form" enctype="multipart/form-data">
		{!! csrf_field() !!}
	    @include('books.partials.form', compact('submitButtonText', 'authors'))
    <form>
@endsection