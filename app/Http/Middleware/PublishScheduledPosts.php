<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Post;

class PublishScheduledPosts
{
    public function handle($request, Closure $next)
    {
        Post::where('is_published', false)
            ->where('publish_at', '<=', now())
            ->update(['is_published' => true]);

        return $next($request);
    }
}
