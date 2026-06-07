@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
    <!--  post details -->
    <div class="container mt-5">
        <div class="card shadow-sm col-md-8 mx-auto">
            <div class="card-header bg-light">
                <h5 class="m-0 text-muted">Post Details</h5>
            </div>
            <div class="card-body">
                <h4 class="card-title text-dark fw-bold mb-3">{{ $post['title'] }}</h4>
                <p class="card-text text-secondary">{{ $post['description'] }}</p>
            </div>
            <div class="card-footer bg-light d-flex justify-content-end">
                <a href="{{ url('/posts') }}" class="btn btn-secondary btn-sm">All Posts</a>
            </div>
        </div>
    </div>
@endsection