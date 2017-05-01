@extends('layouts.main')

@section('main')
	@forelse($books as $book)
        @include('books.partials.book')
    @empty
        Книги не найдены
    @endforelse
    <hr>
    {!! $books->links() !!}
@endsection