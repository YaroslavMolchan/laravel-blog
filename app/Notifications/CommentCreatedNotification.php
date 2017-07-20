<?php

namespace App\Notifications;

use App\Entities\ArticlesComment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CommentCreatedNotification extends Notification
{
    use Queueable;
    /**
     * @var ArticlesComment
     */
    private $comment;

    /**
     * Create a new notification instance.
     *
     * @param ArticlesComment $comment
     */
    public function __construct(ArticlesComment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Новый комментарий к блогу')
            ->greeting($this->comment->article->title)
            ->line("Пользователь {$this->comment->name} ({$this->comment->email}) оставил комментарий")
            ->action('Перейти к записи', route('articles.show', [
                'id' => $this->comment->article_id,
                'slug' => $this->comment->article->alias
            ]));
    }
}
