<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use Illuminate\Support\Facades\Log;

class NotifyAdminOfComment
{
    /**
     * Handle the event.
     *
     * @param \App\Events\CommentCreated $event
     */
    public function handle(CommentCreated $event)
    {
        Log::info('New comment created:', [
            'author' => $event->comment->author_name,
            'content' => $event->comment->content,
            'post_id' => $event->comment->post_id,
        ]);
    }
}
