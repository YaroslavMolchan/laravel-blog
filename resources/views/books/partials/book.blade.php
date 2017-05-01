<article class="member">
    <h3 class="member-name">{!! $book->title !!}</h3>
    <h4 class="member-position">
        @foreach($book->authors as $author)
            {!! $author->name !!}@if(!$loop->last), @endif
        @endforeach
    </h4>
    <p class="member-bio">
        {!! $book->description !!}
    </p>
    <div class="member-avatar">
        <img alt="" src="{!! \Storage::url($book->image) !!}">
    </div>
</article>
