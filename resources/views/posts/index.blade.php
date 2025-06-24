@extends('layout')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-10">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">All Blog Posts</h1>

        @forelse ($posts as $post)
            <div class="bg-white p-6 rounded-2xl shadow mb-6 hover:shadow-md transition">
                <h2 class="text-2xl font-semibold text-blue-700 hover:underline">
                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                </h2>
                <p class="text-sm text-gray-500 mb-2">by {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}</p>
                <p class="text-gray-700">{{ Str::limit($post->body, 150, '...') }}</p>
            </div>
        @empty
            <p class="text-gray-500">No blog posts found.</p>
        @endforelse
    </div>
@endsection
