@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Completed Tasks</h1>
        <a href="{{ route('tasks.index') }}" class="btn btn-primary">Back to Tasks</a>

        @if ($tasks->isEmpty())
            <p class="mt-3">No completed tasks found.</p>
        @else
            <ul class="list-group mt-3">
                @foreach ($tasks as $task)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $task->title }}</strong>
                            <br>
                            <small>Completed at: {{ $task->completed_at->format('d-m-Y H:i') }}</small>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
