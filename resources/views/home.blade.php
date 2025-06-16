@extends('layout')

@section('content')
  @auth
    <h1>Welcome @auth, {{ auth()->user()->name }}@endauth</h1>

    <form action="/logout" method="POST">
      @csrf
      <button type="submit">Logout</button>
    </form>

    <h2>Create Post</h2>
    <form action="/create-post" method="POST">
      @csrf
      <input name="title" type="text" placeholder="Post title" required><br>
      <textarea name="body" placeholder="Post content..." required></textarea><br>
      <button type="submit">Create Post</button>
    </form>

    <h2>All Posts</h2>
    @foreach ($posts as $post)
      <div style="border: 1px solid black; padding: 10px; margin-bottom: 10px;">
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->body }}</p>
        <p>Posted by {{ $post->user->name }} at {{ $post->created_at->format('d M Y H:i') }}</p>

        @if(auth()->user()->id === $post->user_id)
          <a href="/edit-post/{{ $post->id }}">Edit</a>
          <form action="/delete-post/{{ $post->id }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
          </form>
        @endif
      </div>
    @endforeach
  @else
    <h1>Welcome Guest</h1>

    <div style="border: 1px solid black; padding: 10px; margin-bottom: 10px;">
      <h2>Register</h2>
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br>
        <button type="submit">Register</button>
      </form>
    </div>

    <div style="border: 1px solid black; padding: 10px;">
      <h2>Login</h2>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
      </form>
    </div>
  @endauth
@endsection
