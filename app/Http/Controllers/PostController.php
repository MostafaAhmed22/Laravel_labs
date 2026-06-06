<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    private function getPosts()
    {
        return [
            1 => ['id' => 1, 'title' => 'Real Madrid', 'description' => 'The kings of Europe with the most UEFA Champions League trophies.'],
            2 => ['id' => 2, 'title' => 'Barcelona', 'description' => 'Famous for their tiki-taka passing style and the legendary La Masia academy.'],
            3 => ['id' => 3, 'title' => 'Manchester United', 'description' => 'One of the most supported clubs globally, known as the Red Devils.'],
            4 => ['id' => 4, 'title' => 'Liverpool', 'description' => 'An iconic English club famous for their passionate fans and "You\'ll Never Walk Alone" anthem.'],
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
