@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Task</h1>

        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $task->title) }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', $task->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="due_date" class="form-label">Due Date</label>
                <input type="date" name="due_date" id="due_date" class="form-control"
                    value="{{ old('due_date', $task->due_date) }}">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="completed" id="completed" class="form-check-input"
                    {{ $task->completed ? 'checked' : '' }}>
                <label for="completed" class="form-check-label">Completed</label>
            </div>
            <button type="submit" class="btn btn-success">Save Changes</button>
        </form>
    </div>
@endsection
