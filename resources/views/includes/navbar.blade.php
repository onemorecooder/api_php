<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">The Movie Database</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('movies.index') }}">Películas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tvshows.index') }}">Series</a>
                </li>
            </ul>
            <a href="{{ route('selectApi') }}" class="btn btn-secondary">🏠</a>
            <form class="form-inline ml-auto" action="{{ route('logout') }}" method="GET">
                @csrf
                <button class="btn btn-outline-light" type="submit">Logout</button>
            </form>
        </div>
    </nav>

</body>

</html>
