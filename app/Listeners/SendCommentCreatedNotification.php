<?php

namespace App\Listeners;

use App\Entities\User;
use App\Events\CommentCreate;
use App\Notifications\CommentCreatedNotification;

class SendCommentCreatedNotification
{
    /**
     * Handle the event.
     *
     * @param  CommentCreate  $event
     * @return void
     */
    public function handle(CommentCreate $event)
    {
        $admins = User::where('status', User::STATUS_ADMIN)->get();

        \Notification::send($admins, new CommentCreatedNotification($event->comment));
    }
}
