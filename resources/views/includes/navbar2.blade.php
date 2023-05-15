<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Trello Project</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <a href="{{ route('selectApi') }}" class="btn btn-secondary">🏠</a>
            <form class="form-inline ml-auto" action="{{ route('logout') }}" method="GET">
                @csrf
                <button class="btn btn-outline-light" type="submit">Logout</button>
            </form>
        </div>
    </nav>

</body>

</html>
