<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Login</title>
</head>

<body>
    @include('includes.navbarLogin')
    <div class="container mt-5">
        <h1>Selecciona una API</h1>
        <div class="row mt-4">
            <div class="col-md-6">
                <a href="{{ route('boards.show') }}" class="btn btn-primary btn-lg btn-block">Trello API</a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('movies.index') }}" class="btn btn-primary btn-lg btn-block">TMDB API</a>
            </div>
        </div>
    </div>
    @include('includes.footer')
</body>

</html>
