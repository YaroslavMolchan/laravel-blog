<div class="comment">
    <div class="avatar"><img src="http://www.gravatar.com/avatar/?d=mm&amp;s=50" alt="" /></div>
    <div class="comment-meta">
        <strong>{{ $comment->name }}</strong>
        <span class="date">
            {!! $comment->created_at->diffForHumans() !!}
        </span>
        /
        <span>
            <a class="reply" href="#" data-id="{!! $comment->parent_id ?? $comment->id !!}">Reply</a>
            @if(Auth::check())
                / <a href="#" class="delete" rel="{{ route('comments.destroy', ['id' => $comment->id]) }}">Delete</a>
            @endif
        </span>
    </div>
    <div class="comment-body">
        {{ $comment->comment }}
    </div>
</div>