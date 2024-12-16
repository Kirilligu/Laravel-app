@extends('layouts.app')

@section('content')
<h1>Posts</h1>
<a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create Post</a>
@foreach ($posts as $post)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->content }}</p>
            <p>
                <small>
                    Publish At: {{ $post->publish_at }} | 
                    Status: {{ $post->is_published ? 'Published' : 'Draft' }}
                </small>
            </p>
            <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>

            @if ($post->is_published)
                <form action="{{ route('posts.toggleUnpublish', $post) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-warning">Unpublish</button>
                </form>
            @endif
        </div>
        <div class="mt-4">
            <h5>Leave a Comment</h5>
            <form action="{{ route('comments.store', $post) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="author_name_{{ $post->id }}" class="form-label">Your Name:</label>
                    <input type="text" name="author_name" id="author_name_{{ $post->id }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="content_{{ $post->id }}" class="form-label">Comment:</label>
                    <textarea name="content" id="content_{{ $post->id }}" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            @if(session('success') && session('post_id') == $post->id)
                <p class="text-success mt-2">{{ session('success') }}</p>
            @endif
            <h5 class="mt-4">Comments</h5>
            @forelse($post->comments->where('is_approved', true) as $comment)
                <div class="mb-3">
                    <p><strong>{{ $comment->author_name }}</strong>: {{ $comment->content }}</p>
                </div>
            @empty
                <p>No comments yet.</p>
            @endforelse
        </div>
    </div>
@endforeach

{{ $posts->links() }}
@endsection
