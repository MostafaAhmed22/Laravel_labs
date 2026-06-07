@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<div class="container mx-auto px-4 mt-12 max-w-6xl">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">My Posts</h1>
        </div>
        <div>
            <a href="{{ url('/posts/create') }}" class="inline-flex items-center justify-center rounded-lg bg-red-50 px-5 py-2.5 text-sm font-medium text-red-700 transition hover:bg-red-100 focus:outline-none shadow-sm">
                Create Post
            </a>
        </div>
    </div>

    <div class="overflow-x-auto rounded-xl border border-gray-100 bg-white shadow-sm">
        <table class="min-w-full divide-y-2 divide-gray-100 text-sm">
            <thead class="bg-gray-50 text-left">
                <tr>
                    <th class="whitespace-nowrap px-6 py-4 font-semibold text-gray-900">Title</th>
                    <th class="whitespace-nowrap px-6 py-4 font-semibold text-gray-900">Description</th>
                    <th class="whitespace-nowrap px-6 py-4 font-semibold text-gray-900">Created At</th>
                    <th class="whitespace-nowrap px-6 py-4 font-semibold text-gray-900">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @foreach($posts as $post)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 max-w-xs truncate">
                        {{ $post['title'] }}
                    </td>
                    
                    <td class="px-6 py-4 text-gray-600 max-w-md truncate">
                        {{ $post['description'] }}
                    </td>
                    <td class="px-6 py-4 text-gray-600 max-w-md truncate">
                        {{ \Carbon\Carbon::parse($post['created_at'])->format('M d, Y') }}
                    </td>
                    
                    <td class="whitespace-nowrap px-6 py-4 text-center">
                        <div x-data="{ openDeleteModal: false }" class="inline-flex items-center gap-3 justify-center">
                            @if($post->trashed())
                                <form action="{{ url('/posts/restore/'.$post['id']) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center justify-center rounded-md bg-green-50 px-3 py-1.5 text-xs font-semibold text-green-700 hover:bg-green-100 transition">
                                        Restore
                                    </button>
                                </form>
                            @else
                                <a href="{{ url('/posts/show/'.$post['id']) }}" class="inline-flex items-center justify-center rounded-md bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700 hover:bg-indigo-100 transition">
                                    Show
                                </a>

                                <a href="{{ url('/posts/edit/'.$post['id']) }}" class="inline-flex items-center justify-center rounded-md bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700 hover:bg-amber-100 transition">
                                    Edit
                                </a>

                                <button type="button" @click="openDeleteModal = true" class="inline-flex items-center justify-center rounded-md bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100 transition">
                                    Delete
                                </button>
                            @endif

                            <div x-show="openDeleteModal" 
                             x-transition.opacity
                             class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
                             style="display: none;">
                            
                            <!-- Modal Content Panel -->
            <div @click.away="openDeleteModal = false" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="w-full max-w-sm rounded-xl border border-gray-100 bg-white p-6 shadow-lg text-left whitespace-normal">
                
                <h3 class="text-base font-bold text-gray-900">
                    Delete Post
                </h3>

                <p class="mt-2 text-sm text-gray-500">
                    Are you sure you want to delete <span class="font-semibold text-gray-800">"{{ $post['title'] }}"</span> ?
                </p>

                <!-- Action Confirmation Buttons -->
                <div class="mt-6 flex justify-end gap-2">
                    <button @click="openDeleteModal = false" type="button" class="rounded-md bg-gray-100 px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-200 transition">
                        No
                    </button>

                    <!-- Actual Functional Form Action Submission -->
                    <form action="{{ url('/posts/destroy/'.$post['id']) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-md bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-700 transition">
                            Yes, delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection