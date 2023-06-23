<div class="container">
    <h1>Create Book</h1>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="isbn">ISBN:</label>
            <input type="text" name="isbn" class="form-control" pattern="[0-9]+" required>
        </div>

        <div class="form-group">
            <label for="value">Value:</label>
            <input type="number" name="value" class="form-control" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>