@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="container mx-auto px-4 mt-12 max-w-2xl">
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Post</h1>
            <a href="{{ url('/posts') }}" class="text-sm text-gray-500 hover:text-gray-700">Back to Posts</a>
        </div>

        <form action="{{ url('/posts/update/'.$post['id']) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" 
                    class="w-full rounded-lg border-gray-200 p-3 text-sm shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description Input -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="5" 
                    class="w-full rounded-lg border-gray-200 p-3 text-sm shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 @error('description') border-red-500 @enderror">{{ old('description', $post->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-block rounded-lg bg-red-50 px-5 py-3 text-sm font-medium text-red-700 hover:bg-red-100 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection