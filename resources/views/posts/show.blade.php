<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-50 p-4 border border-green-100">
                <div class="flex items-center gap-2 text-green-700 text-sm font-medium">
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif

            {{-- Back Navigation Context Shortcut --}}
            <div class="mb-6">
                <a href="{{ url('/posts') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-red-600 transition">
                    Back to Posts
                </a>
            </div>

            {{-- Main Document Card Content --}}
            <article class="overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm sm:p-8">

                <div class="flex items-center justify-between gap-4 border-b border-gray-100 pb-4 mb-6">
                    <span class="rounded bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">
                        Post Structure
                    </span>
                    <span class="text-xs text-gray-400">
                        {{ \Carbon\Carbon::parse($post->created_at)->format('M d, Y') }}
                    </span>
                </div>

                <div>
                    <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl tracking-tight mb-4">
                        {{ $post->title }}
                    </h1>

                    <h6 class="text-sm text-gray-700 mb-2">
                        Created By: {{ $post->user->name }}
                    </h6>
                    <p class="text-base text-gray-600 leading-relaxed whitespace-pre-line">
                        {{ $post->description }}
                    </p>

                    @if($post->image)
                    <div class="mt-4">
                        <img src="{{asset('storage/'.$post->image)}}" alt="{{ $post->title }}" class="w-full h-auto rounded-lg shadow-sm">
                    </div>
                    @endif


                    @if($post->tags->count() > 0)
                    <div class="flex flex-wrap gap-2 mt-4">
                        @foreach($post->tags as $tag)
                        <span class="inline-flex items-center rounded-md bg-red-50 dark:bg-red-950/40 px-2.5 py-0.5 text-xs text-red-700 dark:text-red-400">
                            {{ $tag->name }}
                        </span>
                        @endforeach
                    </div>
                    @endif
                </div>

            </article>

            {{-- Comments Display Section Stack --}}
            <div class="mt-12">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    Comments ({{ $post->comments->count() }})
                </h2>

                @forelse($post->comments as $comment)
                <div class="border border-gray-200 rounded-xl p-4 mb-4 bg-white shadow-sm">
                    <p class="text-gray-700 text-sm leading-relaxed">{{ $comment->content }}</p>
                    <p class="text-xs text-gray-400 mt-2 font-medium">
                        By {{ $comment->user->name ?? 'Anonymous' }} on {{ \Carbon\Carbon::parse($comment->created_at)->format('M d, Y') }}
                    </p>
                </div>
                @empty
                <p class="text-sm text-gray-400 italic mb-4">No comments posted yet.</p>
                @endforelse
            </div>

            {{-- Add Interactive Comment Input Box Form Block --}}
            <div class="mt-8 border-t border-gray-200 pt-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Add a Comment</h3>

                <form action="{{ url('/comments') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">
                            Your Message
                        </label>
                        <textarea id="content" name="content" rows="4"
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required placeholder="Write something meaningful..."></textarea>
                    </div>

                    <div>
                        <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-indigo-50 px-4 py-2.5 text-sm font-semibold text-indigo-700 hover:bg-indigo-100 transition">
                            Submit Comment
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>