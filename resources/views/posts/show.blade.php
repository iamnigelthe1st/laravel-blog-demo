@extends('layout')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-10">
        <div class="bg-white p-8 rounded-2xl shadow-md">
            <h1 class="text-4xl font-bold text-blue-800 mb-2">{{ $post->title }}</h1>
            <p class="text-sm text-gray-500 mb-6">By {{ $post->user->name }} • {{ $post->created_at->format('F j, Y') }}</p>

            <div class="text-gray-800 leading-relaxed">
                {!! nl2br(e($post->body)) !!}
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('posts.index') }}" class="inline-block text-blue-600 hover:underline">← Back to all posts</a>
        </div>
    </div>
@endsection
