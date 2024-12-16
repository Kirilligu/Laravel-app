@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Post</h1>
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control"
                   value="{{ old('title', $post->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="publish_at" class="form-label">Publish At</label>
            <input type="datetime-local" name="publish_at" id="publish_at" class="form-control"
                   value="{{ old('publish_at', $post->publish_at ? $post->publish_at->format('Y-m-d\TH:i') : '' ) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
@endsection