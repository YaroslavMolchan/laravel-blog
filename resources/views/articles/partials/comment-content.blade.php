<div class="comment">
    <div class="avatar"><img src="http://www.gravatar.com/avatar/?d=mm&amp;s=50" alt="" /></div>
    <div class="comment-meta">
        <strong>{{ $comment->name }}</strong>
        <span class="date">{!! $comment->created_at->diffForHumans() !!}</span> / <span class="reply" data-id="{!! $comment->parent_id ?? $comment->id !!}"><a href="#">Reply</a></span>
    </div>
    <div class="comment-body">
        {{ $comment->comment }}
    </div>
</div>