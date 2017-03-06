<section id="comments">
    <h4>Комментарии <span>({{ $article->comments()->count() }})</span></h4>
    <ol class="commentlist">
        @forelse($article->mainComments() as $comment)
            <li>
                @include('articles.partials.comment-content')

                @if($comment->comments()->count() > 0)
                    @foreach($comment->comments as $subcomment)
                        <ol class="comment-replies">
                            <li>
                                @include('articles.partials.comment-content', ['comment' => $subcomment])
                            </li>                
                        </ol>
                    @endforeach
                @endif
            </li>
        @empty
            <li>
                <hr>
                Комментариев пока нет.
                <hr>
            </li>
        @endforelse
    </ol><!-- end .commentlist -->

    {{-- <h4>Оставьте комментарий</h4> --}}
    {{-- <br /> --}}

    <!-- Comment form
    ================================================== -->
    <form action="/comments" class="row" method="POST" id="comments-form">
        {{ csrf_field() }}
        <input type="hidden" name="article_id" value="{!! $article->id !!}">
        <input type="hidden" name="comment_id">
        <div class="span3">
            <label>Имя</label>
            <input type="text" name="name" placeholder="Ваше имя" />
            <div class="help-block"></div>
        </div>
        <div class="span3">
            <label>E-mail</label>
            <input type="text" name="email" placeholder="Ваш E-mail" />
            <div class="help-block"></div>
        </div>
        <div class="span8">
            <label>Комментарий</label>
            <textarea name="comment" rows="6" placeholder="Ваш комментарий"></textarea>
            <div class="help-block"></div>
            <p>
                <button type="submit" class="button yellow"><i class="icon-ok"></i> Отправить</button>
            </p>
        </div>
    </form>

</section>