<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required',
        ]);

        $post->comments()->create($validated);
        return back();
    }

    public function approve(Comment $comment)
    {
        $comment->update(['is_approved' => true]);
        return back();
    }
}