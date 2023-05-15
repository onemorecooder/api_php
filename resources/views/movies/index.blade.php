<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Login</title>
</head>

<body>
    @include('includes.navbar')

    <div class="container mt-5">
        @if (isset($movie))
            <h1>{{ $movie['title'] }}</h1>
            <p>{{ $movie['overview'] }}</p>
            <a href="{{ route('movies.index') }}" class="btn btn-primary">Volver a la lista de películas</a>
        @else
            <h1>Películas</h1>
            <form method="GET" action="{{ route('movies.index') }}" class="mb-3">
                <div class="form-group">
                    <label for="movie">Selecciona una película:</label>
                    <select name="movie" id="movie" class="form-control">
                        @foreach ($movies as $movie)
                            <option value="{{ $movie['id'] }}">{{ $movie['title'] }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Ver detalles</button>
            </form>
        @endif
    </div>
    @include('includes.footer')
</body>

</html>
