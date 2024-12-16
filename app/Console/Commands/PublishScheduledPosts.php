<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class PublishScheduledPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish scheduled posts that are ready for publication';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = Post::where('is_published', false)
            ->where('publish_at', '<=', now())
            ->update(['is_published' => true]);
        $this->info("Published $count posts.");

        return Command::SUCCESS;
    }
}
