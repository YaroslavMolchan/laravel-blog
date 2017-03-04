@extends('layouts.app')

@section('content')
	@forelse($articles as $article)
        @include('articles.partials.article')
    @empty
        Записи не найдены
    @endforelse

    <hr>
    {!! $articles->links() !!}
@endsection