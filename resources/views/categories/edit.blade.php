@extends('layouts.app')

@section('content')
	{!! Form::model($article, ['url' => '/categories/'.$article->id, 'method' => 'PUT', 'class' => 'row main-form']) !!}
	    @include('categories.form')
    {!! Form::close() !!}
@endsection