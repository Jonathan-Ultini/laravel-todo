<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::whereNull('completed_at')->orderBy('due_date', 'asc')->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $validated['user_id'] = Auth::id();

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function edit(Task $task)
    {
        // Verifica che l'utente sia il proprietario dell'attività
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        // Verifica che l'utente sia il proprietario dell'attività
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'completed' => 'boolean',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    // Mostra il cestino
    public function trash()
    {
        $trashedTasks = Task::onlyTrashed()->get(); // Recupera solo i record eliminati
        return view('tasks.trash', compact('trashedTasks'));
    }

    // Ripristina un'attività
    public function restore($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->restore();

        return redirect()->route('tasks.trash')->with('success', 'Task restored successfully!');
    }

    // Elimina definitivamente un'attività
    public function forceDelete($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->forceDelete();

        return redirect()->route('tasks.trash')->with('success', 'Task permanently deleted!');
    }

    //completa una task
    public function complete(Task $task)
    {
        // Controlla se la task è già completata
        if ($task->completed_at) {
            return redirect()->route('tasks.index')->with('error', 'Task already completed.');
        }

        // Aggiorna la task con la data di completamento
        $task->update(['completed_at' => now()]);

        // Redirige alla lista delle task con un messaggio di successo
        return redirect()->route('tasks.index')->with('success', 'Task marked as completed!');
    }


    //visualizza le task complete
    public function completed()
    {
        $tasks = Task::whereNotNull('completed_at')->orderBy('completed_at', 'desc')->get();

        return view('tasks.completed', compact('tasks'));
    }
}
