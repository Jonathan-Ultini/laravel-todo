@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Trash</h1>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary mb-3">Back to Tasks</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($trashedTasks->isEmpty())
            <p>No tasks in the trash.</p>
        @else
            <ul class="list-group">
                @foreach ($trashedTasks as $task)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $task->title }}</strong>
                            <br>
                            <small>{{ $task->due_date ? 'Due: ' . $task->due_date : 'No due date' }}</small>
                        </div>
                        <span>
                            <form action="{{ route('tasks.restore', $task->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Restore</button>
                            </form>
                            <form action="{{ route('tasks.forceDelete', $task->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete Permanently</button>
                            </form>
                        </span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
