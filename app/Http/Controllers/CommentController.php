<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Providers\AuthServiceProvider;
use Posts;

class CommentController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //allow admin and super admin to create comment using allows
        if (Gate::allows('is_admin')) {
            return view('comments.create');
        }
        abort(401, 'Unauthorized');
        //return view('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();
        Comment::create($validated);
        return redirect()->back()->with('success', 'Comment added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
        return view('comments.show', compact('comment'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully');
    }
}
