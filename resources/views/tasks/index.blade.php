@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tasks</h1>
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add Task</a>
            <a href="{{ route('tasks.trash') }}" class="btn btn-secondary">View Trash</a>
        </div>

        <ul class="list-group mt-3">
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $task->title }}</strong>
                        <br>
                        <small>{{ $task->due_date ? 'Due: ' . $task->due_date : 'No due date' }}</small>
                    </div>
                    <span>
                        <form action="{{ route('tasks.complete', $task) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Complete</button>
                        </form>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                        </form>
                    </span>
                </li>
            @endforeach
        </ul>

    </div>
@endsection
