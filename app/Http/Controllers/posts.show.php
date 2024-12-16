<h2>Comments</h2>
@forelse($post->comments->where('is_approved', true) as $comment)
    <div>
        <p><strong>{{ $comment->author_name }}</strong>:</p>
        <p>{{ $comment->content }}</p>
    </div>
@empty
    <p>No comments yet.</p>
@endforelse
