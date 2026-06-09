<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

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
        $post = Post::findOrFail($id);

        return view('posts/show', compact('post'));
    }

    // edit post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts/edit', compact('post'));
    }

    // update post
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return redirect('/posts');
    }

    public function create()
    {
        return view('posts/create');
    }
    
    //store post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return redirect('/posts');
    }

    //delete post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect('/posts');
    }

    // restore post
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect('/posts');
    }
}
