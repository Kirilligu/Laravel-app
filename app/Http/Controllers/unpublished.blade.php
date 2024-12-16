@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Unpublished Posts</h1>
    @foreach ($posts as $post)
        <div class="post">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            <form action="{{ route('posts.toggle-publish', $post->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-success">Publish</button>
            </form>
        </div>
    @endforeach
</div>
@endsection
