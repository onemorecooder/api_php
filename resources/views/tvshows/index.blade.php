<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Login</title>
</head>

<body>
    @include('includes.navbar')

    <div class="container mt-5">
        @if (isset($serie))
            <h1>{{ $serie['name'] }}</h1>
            <p>{{ $serie['overview'] }}</p>
            <a href="{{ route('tvshows.index') }}" class="btn btn-primary">Volver a la lista de series</a>
        @else
            <h1>Series</h1>
            <form method="GET" action="{{ route('tvshows.index') }}" class="mb-3">
                <div class="form-group">
                    <label for="series">Selecciona una serie:</label>
                    <select name="series" id="series" class="form-control">
                        @foreach ($series as $serie)
                            <option value="{{ $serie['id'] }}">{{ $serie['name'] }}</option>
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
