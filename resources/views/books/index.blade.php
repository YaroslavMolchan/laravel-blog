@extends('layouts.main')

@section('main')
    @each('books.partials.book', $books, 'book', 'layouts.empty')
    <hr>
    {!! $books->links() !!}
@endsection
