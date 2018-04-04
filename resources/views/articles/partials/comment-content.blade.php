<div class="comment">
    <div class="avatar"><img src="{{ $comment->avatar() }}" alt="" /></div>
    <div class="comment-meta">
        <strong class="name">{{ $comment->name }}</strong>
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