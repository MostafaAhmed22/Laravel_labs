<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    private function getPosts()
    {
        return [
            1 => ['id' => 1, 'title' => 'Post1 tilte', 'description' => 'post1 description'],
            2 => ['id' => 2, 'title' => 'Post2 tilte', 'description' => 'post2 description'],
            3 => ['id' => 3, 'title' => 'Post3 tilte', 'description' => 'post3 description'],
            4 => ['id' => 4, 'title' => 'Post4 tilte', 'description' => 'post4 description'],
        ];
    }

    // home page with  slider
    public function home()
    {
        return view('home');
    }

    
    // all posts
    public function index()
    {
        $posts = $this->getPosts();

        return view('posts/index', compact('posts'));
    }

  
    // specified post
    public function show($id)
    {
        $posts = $this->getPosts();


        $post = $posts[$id];

        return view('posts/show', compact('post'));
    }
}
