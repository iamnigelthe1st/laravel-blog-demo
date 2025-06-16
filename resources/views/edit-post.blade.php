<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>

    <form method="POST" action="/edit-post/{{ $post->id }}">
        @csrf
        @method('PUT')

        <input type="text" name="title" value="{{ $post->title }}" required><br><br>
        <textarea name="body" required>{{ $post->body }}</textarea><br><br>

        <button type="submit">Update Post</button>
    </form>

    <br>
    <a href="/">Back to Home</a>
</body>
</html>
