@extends('layouts.app')

@section('content')
    <h1>Moderate Comments</h1>

    @if($comments->isEmpty())
        <p>No comments to moderate.</p>
    @else
        @foreach($comments as $comment)
            <div>
                <p><strong>{{ $comment->author_name }}</strong>: {{ $comment->content }}</p>
                <form action="{{ route('comments.approve', $comment) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit">Approve</button>
                </form>
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        @endforeach

        {{ $comments->links() }}
    @endif
@endsection
