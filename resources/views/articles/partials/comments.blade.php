<section id="comments">

    <h4>Комментарии <span>({{ $article->comments()->count() }})</span></h4>

    <ol class="commentlist">
        @forelse($article->comments as $comment)
            <li>
                <div class="comment">
                    <div class="avatar"><img src="http://www.gravatar.com/avatar/?d=mm&amp;s=50" alt="" /></div>
                    <div class="comment-meta">
                        <strong>{{ $comment->name }}</strong>
                        <span class="date">{!! $comment->created_at->diffForHumans() !!}</span> / <span class="reply" data-id="{!! $comment->id !!}"><a href="#">Reply</a></span>
                    </div>
                    <div class="comment-body">
                        {{ $comment->comment }}
                    </div>
                </div>
            </li>
        @empty
            <li>
                <hr>
                Комментариев пока нет.
            </li>
        @endforelse
    </ol><!-- end .commentlist -->

    <h4>Оставьте комментарий</h4>
    <br />

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