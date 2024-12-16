@extends('layouts.app')

@section('content')
<h1>Published Posts</h1>
@foreach ($posts as $post)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->content }}</p>
            <p><small>Published At: {{ $post->publish_at }}</small></p>
        </div>
    </div>
@endforeach
{{ $posts->links() }}
@endsection
