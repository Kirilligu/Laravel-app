@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Unpublished Posts</h1>

    @if($posts->isEmpty())
    <p>No unpublished posts available.</p>
    @else
    <div class="list-group">
        @foreach($posts as $post)
        <div class="list-group-item mb-3">
            <h5>{{ $post->title }}</h5>
            <form action="{{ route('posts.toggle-publish', $post->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-success">Publish</button>
            </form>
        </div>
        @endforeach
    </div>
    {{ $posts->links() }}
    @endif
</div>
@endsection
