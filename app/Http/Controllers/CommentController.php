<?php
namespace App\Http\Controllers;
use App\Events\CommentCreated;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
class CommentController extends Controller
{
    public function store(Request $request, Post $post)
{
    $comment = new Comment([
        'author_name' => $request->input('author_name'),
        'content' => $request->input('content'),
        'post_id' => $post->id,
        'is_approved' => false,
    ]);
    $comment->save();
    event(new CommentCreated($comment));
    return redirect()->route('posts.index')->with('success', 'Comment submitted successfully and awaiting approval.');
}
    public function moderate()
    {
        $comments = Comment::where('is_approved', false)->orderBy('created_at', 'desc')->paginate(10);
        return view('comments.moderate', compact('comments'));
    }
    public function approve(Comment $comment)
    {
        $comment->update(['is_approved' => true]);
        return redirect()->route('comments.moderate')->with('success', 'Comment approved successfully.');
    }
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('comments.moderate')->with('success', 'Comment deleted successfully.');
    }
}
