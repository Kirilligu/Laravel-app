<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class PublishPosts extends Command
{
    protected $signature = 'posts:publish';
    protected $description = 'Publish scheduled posts';

    public function handle()
    {
        $published = Post::where('is_published', false)
            ->where('publish_at', '<=', now())
            ->update(['is_published' => true]);

        $this->info("Published {$published} posts.");
    }
}
