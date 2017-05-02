<article class="member">
    <h3 class="member-name">
        @if(!empty($book->link))
            <a href="{!! $book->title !!}" target="_blank">{!! $book->title !!}</a>
        @else
            {!! $book->title !!}
        @endif
    </h3>
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
