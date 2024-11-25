@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tasks</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add Task</a>

        <ul class="list-group mt-3">
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $task->title }}
                    <span>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
