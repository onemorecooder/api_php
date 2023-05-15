<!DOCTYPE html>
<html>

<head>
    <title>Trello Cards</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    @include('includes.navbar2')
    <div class="container mt-5">
        <h1>My Trello Boards</h1>
        <div class="row">
            <div class="col">
                <div class="card-deck">
                    @foreach ($boards as $board)
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ $board->name }}</h5>
                                <p class="card-text">Accede a tu tabla para añadir listas.</p>
                                <a href="{{ route('cards.index', ['boardId' => $board->id]) }}"
                                    class="btn btn-primary">Go to Cards</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
</body>
