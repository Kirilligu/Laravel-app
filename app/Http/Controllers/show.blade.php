<h2>Leave a Comment</h2>
<form action="{{ route('comments.store', $post) }}" method="POST">
    @csrf
    <div>
        <label for="author_name">Your Name:</label>
        <input type="text" name="author_name" id="author_name" required>
    </div>
    <div>
        <label for="content">Comment:</label>
        <textarea name="content" id="content" rows="5" required></textarea>
    </div>
    <button type="submit">Submit</button>
</form>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif


