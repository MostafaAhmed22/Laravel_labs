<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/home') }}">ITIBlog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/posts') }}">Posts</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>