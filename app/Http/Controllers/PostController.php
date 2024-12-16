<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class PostController extends Controller
{
    public function publishPosts()
{
    $publishedPosts = Post::where('is_published', false)
        ->where('publish_at', '<=', now())
        ->update(['is_published' => true]);

    return response()->json([
        'message' => "Published {$publishedPosts} posts."
    ]);
}
public function toggleUnpublish(Post $post)
{
    $post->is_published = false;
    $post->save();
    return redirect()->route('posts.unpublished')->with('success', 'Post unpublished successfully.');
}
public function togglePublish(Post $post)
    {
        $post->is_published = !$post->is_published;
        $post->save();
        return redirect()->route('posts.index');
    }
public function unpublished()
{
    $posts = Post::where('is_published', false)
                 ->orderBy('publish_at', 'desc')
                 ->paginate(10);

    return view('posts.unpublished', compact('posts'));
}
    public function published()
{
    $posts = Post::where('is_published', true)
                 ->orderBy('publish_at', 'desc')
                 ->paginate(10);

    return view('posts.published', compact('posts'));
}
public function index()
{
    $this->publishScheduledPosts();
    $posts = Post::where('is_published', true)
                 ->orderBy('publish_at', 'desc')
                 ->paginate(10);

    return view('posts.index', compact('posts'));
}
protected function publishScheduledPosts()
{
    Post::where('is_published', false)
        ->where('publish_at', '<=', now())
        ->update(['is_published' => true]);
}
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'publish_at' => 'required|date|after_or_equal:now',
    ]);

    $validated['is_published'] = false;

    Post::create($validated);

    return redirect()->route('posts.index')->with('success', 'Post created successfully!');
}
public function edit(Post $post)
{
    return view('posts.edit', compact('post'));
}
public function update(Request $request, Post $post)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'publish_at' => 'nullable|date',
    ]);
    $post->update($validated);
    return redirect()->route('posts.index')->with('success', 'Post updated successfully!');

}
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
    public function show(Post $post)
{
    $post->load('comments');
    return view('posts.show', compact('post'));
}

}