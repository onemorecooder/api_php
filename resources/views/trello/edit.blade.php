<!DOCTYPE html>
<html>

<head>
    <title>Trello Cards</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    @include('includes.navbar2')
    <div class="container">
        <h1 class="mt-4 mb-4">Edit Trello Card</h1>
        <form method="POST" action="{{ route('cards.update', $cardId) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input type="hidden" name="boardId" value="{{ $boardId }}">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value="{{ $card['name'] }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description">{{ $card['desc'] }}</textarea>
            </div>
            <div class="form-group">
                <label for="dueDate">Due Date:</label>
                <input type="date" class="form-control" name="dueDate"
                    value="{{ $card['due'] ? date('Y-m-d', strtotime($card['due'])) : '' }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Card</button>
            <a href="{{ route('boards.show') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
    @include('includes.footer')
</body>

</html>
