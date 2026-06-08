

@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
<div class="container mx-auto px-4 mt-12 max-w-3xl">

    <div class="mb-6">
        <a href="{{ url('/posts') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-red-600 transition">
            Back to All Posts
        </a>
    </div>

    <article class="overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">
        
        <div class="flex items-center justify-between gap-4 border-b border-gray-100 pb-4 mb-6">
            <span class="rounded bg-red-50 px-2.5 py-1  text-red-700">
                Post Details
            </span>
            
        </div>

        <div>
            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl tracking-tight mb-4">
                {{ $post['title'] }}
            </h1>

            <p class="text-base text-gray-600 leading-relaxed whitespace-pre-line">
                {{ $post['description'] }}
            </p>
            <p> {{ \Carbon\Carbon::parse($post['created_at'])->format('M d, Y') }} </p>

        </div>

    </article>
</div>
@endsection