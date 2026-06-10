<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    //
    // private function getPosts()
    // {
    //     return [
    //         1 => ['id' => 1, 'title' => 'Real Madrid', 'description' => 'The kings of Europe with the most UEFA Champions League trophies.'],
    //         2 => ['id' => 2, 'title' => 'Barcelona', 'description' => 'Famous for their tiki-taka passing style and the legendary La Masia academy.'],
    //         3 => ['id' => 3, 'title' => 'Manchester United', 'description' => 'One of the most supported clubs globally, known as the Red Devils.'],
    //         4 => ['id' => 4, 'title' => 'Liverpool', 'description' => 'An iconic English club famous for their passionate fans and "You\'ll Never Walk Alone" anthem.'],
    //     ];
    // }

    // home page with  slider
    public function home()
    {
        return view('home');
    }

    
    // all posts
    public function index()
    {
        //pagintion 
        $posts = Post::withTrashed()->paginate(10);
        // $posts = Post::withTrashed()->get();
        return view('posts/index', compact('posts'));
    }

  
    // specified post
    public function show($id)
    {
        return view('posts/show', ['post' => Post::findOrFail($id)]);
        $post = Post::findOrFail($id);

        return view('posts/show', compact('post'));
    }

    // edit post
    public function edit($id)
    {
        if(Gate::allows('is_super_admin')){
            $post = Post::findOrFail($id);
            return view('posts/edit', compact('post'));
        }
        abort(401, 'Unauthorized');
        // $post = Post::findOrFail($id);
        // return view('posts/edit', compact('post'));
    }

    // update post
    public function update(StorePostRequest $request, $id)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required',
        // ]);

        $validated = $request->validated();

        $post = Post::findOrFail($id);
        $post->title = $validated['title'];
        $post->description = $validated['description'];
        $post->save();

        if($request->filled('tags')){
            $postTags = collect(explode(',', $request->tags))->map(function ($tag) {
                return trim($tag);
            })->filter()->toArray();

            $post->syncTags($postTags);
        }

        return redirect('/posts');
    }

    public function create()
    {
        if(Gate::allows('is_admin')){
            return view('posts/create');
        }
        abort(401, 'Unauthorized');
        
        // return view('posts/create');
    }
    
    //store post
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('postImage', 'public');
        }

        $userid = Auth::id();
        $post = Post::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $image,
            'user_id' => $userid
        ]);

        if($request->filled('tags')){
            $postTags = collect(explode(',', $request->tags))->map(function ($tag) {
                return trim($tag);
            })->filter()->toArray();

            $post->attachTags($postTags);
        }
        return redirect('/posts')->with('success', 'Post created successfully');
    }

    //delete post
    public function destroy($id)
    {
        if(Gate::allows('is_admin')) {
             $post = Post::findOrFail($id);
             $post->delete();

             return redirect('/posts');
        }
        abort(401, 'Unauthorized');
        //
        // $post = Post::findOrFail($id);
        // $post->delete();

        // return redirect('/posts');
    }

    // restore post
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect('/posts');
    }
}
