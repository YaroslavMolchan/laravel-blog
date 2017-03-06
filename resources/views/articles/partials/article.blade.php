@if(!is_null($article->image))
    <a href="{!! route('articles.show', ['id' => $article->id, 'slug' => $article->alias]) !!}" class="entry-media">
        <img src="{!! \Storage::url($article->image) !!}" alt="{!! $article->title !!}" />
    </a>
@endif
{{--<div style="margin-bottom: 20px; margin-top: 10px">--}}
<div class="post">
    <!-- entry body -->
    <div class="entry-body pull-left">
        <a href="{!! route('articles.show', ['id' => $article->id, 'slug' => $article->alias]) !!}">
            <h2 class="entry-title">{!! $article->title !!}</h2>
        </a>
        <p>{!! $article->short_description !!}</p>
    </div>

    <!-- entry meta -->
    <div class="entry-meta pull-right">
        {{--<span class="entry-type"></span>--}}
        <span class="entry-date">{!! $article->published_at->diffForHumans() !!}</span>
        <span class="entry-comments">{!! $article->comments_count !!} комментариев</span>
    </div>

    <div class="clr"></div>
</div>
