@extends('layouts.app')

@section('content')
	{!! Form::model($article, ['url' => '/articles/'.$article->id, 'method' => 'PUT', 'class' => 'row main-form', 'files' => true]) !!}
		{!! csrf_field() !!}
	    @include('articles.form', compact('submitButtonText', 'categories', 'tags', 'article'))
    {!! Form::close() !!}
@endsection