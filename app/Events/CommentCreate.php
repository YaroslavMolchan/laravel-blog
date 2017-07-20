<?php

namespace App\Events;

use App\Entities\ArticlesComment;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentCreate
{
    use Dispatchable, SerializesModels;
    /**
     * @var ArticlesComment
     */
    public $comment;

    /**
     * Create a new event instance.
     *
     * @param ArticlesComment $comment
     */
    public function __construct(ArticlesComment $comment)
    {
        $this->comment = $comment;
    }
}
