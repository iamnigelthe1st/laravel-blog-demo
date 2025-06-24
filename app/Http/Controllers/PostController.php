<?php

namespace App\Http\Controllers;

use id;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Create Post
    public function createPost(Request $request)
{
    $incomingFields = $request->validate([
        'title' => 'required',
        'body' => 'required'
    ]);

    $incomingFields['title'] = strip_tags($incomingFields['title']);
    $incomingFields['body'] = strip_tags($incomingFields['body']);
    $incomingFields['user_id'] = auth()->id();

    Post::create($incomingFields);

    return redirect('/')->with('success', 'Post created successfully!');
}

    // Show Edit Form
    public function showEditScreen(Post $post)
    {
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/');
        }

        return view('edit-post', ['post' => $post]);
    }

    // Update Post
    public function actuallyUpdatePost(Post $post, Request $request)
{
    if (auth()->user()->id !== $post->user_id) {
        return redirect('/');
    }

    $incomingFields = $request->validate([
        'title' => 'required',
        'body' => 'required'
    ]);

    $incomingFields['title'] = strip_tags($incomingFields['title']);
    $incomingFields['body'] = strip_tags($incomingFields['body']);

    $post->update($incomingFields);

    return redirect('/')->with('success', 'Post updated successfully!');
}

// Show all posts
public function index()
{
    $posts = Post::with('user')->latest()->get();
    return view('posts.index', compact('posts'));
}

public function show(Post $post)
{
    return view('posts.show', compact('post'));
}

//delete post
public function deletePost(Post $post)
{
    if (auth()->user()->id === $post->user_id) {
        $post->delete();
        return redirect('/')->with('success', 'Post deleted successfully!');
    }

    return redirect('/');
}
}
