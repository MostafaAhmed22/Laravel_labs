<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8 border border-gray-100">

                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Create New Post</h1>
                </div>

                <form action="{{ url('/posts/store/') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="w-full rounded-lg border-gray-200 p-3 text-sm shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 @error('title') border-red-500 @enderror">
                        @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" id="description" rows="5"
                            class="w-full rounded-lg border-gray-200 p-3 text-sm shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                        <input type="text" name="tags" id="tags" placeholder="enter post's tags separated by ,"
                            class="w-full rounded-lg border-gray-200 p-3 text-sm shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 @error('tags') border-red-500 @enderror">
                    </div>
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                        <input type="file" name="image" id="image"
                            class="w-full rounded-lg border-gray-200 p-3 text-sm shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500">
                        @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="inline-block rounded-lg bg-red-50 px-5 py-3 text-sm font-medium text-red-700 hover:bg-red-100 transition">
                            Submit
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>