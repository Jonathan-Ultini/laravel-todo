@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Completed Tasks</h1>

        <!-- Bottone per eliminare tutte le task completate -->
        <div class="d-flex justify-content-between mb-3">
            <form action="{{ route('tasks.forceDeleteAll') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Delete All Completed Tasks</button>
            </form>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Tasks</a>
        </div>


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
