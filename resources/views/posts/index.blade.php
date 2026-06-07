@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<div class="container mt-5">
    <h1 class="text-center text-primary mb-4">My Posts</h1>
    <div class="table-responsive bg-white p-3 rounded shadow-sm">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col" class="text-center">View</th>
                    <th scope="col" class="text-center">Edit</th>
                    <th scope="col" class="text-center">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post['title'] }}</td>
                    <td>{{ $post['description'] }}</td>
                    <td class="text-center">
                        <a href="{{ url('/posts/show/'.$post['id']) }}" class="btn btn-sm text-white px-3" style="background-color: #5846f6; border: none;">Show</a>
                    </td>
                    <td class="text-center">
                        <a href="#" class="btn btn-sm btn-warning text-white px-3" style="background-color: #ffca2c; border: none;">Edit</a>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-danger px-3" style="background-color: #dc3545; border: none;">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection