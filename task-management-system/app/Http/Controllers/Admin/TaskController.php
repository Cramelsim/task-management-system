<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskAssigned;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests; // Add this trait to use $this->authorize()

    public function index()
    {
        return view('tasks.index', [
            'tasks' => auth()->user()->tasks()->latest()->paginate(10)
        ]);
    }

    public function create()
    {
        $users = User::where('is_admin', false)->get();
        return view('admin.tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date|after:today',
            'user_id' => 'required|exists:users,id'
        ]);

        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'deadline' => $validated['deadline'],
            'user_id' => $validated['user_id'],
            'created_by' => auth()->id(),
            'status' => 'Pending'
        ]);

        $task->user->notify(new TaskAssigned($task));

        return redirect()->route('admin.tasks.index')->with('success', 'Task assigned successfully!');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $users = User::where('is_admin', false)->get();
        return view('admin.tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date|after:today',
            'user_id' => 'required|exists:users,id'
        ]);

        $task->update($validated);

        return redirect()->route('admin.tasks.index')->with('success', 'Task updated successfully!');
    }

    public function updateStatus(Request $request, Task $task)
    {
        $this->authorize('update', $task);
                
        $validated = $request->validate([
            'status' => 'required|in:Pending,In Progress,Completed'
        ]);

        $task->update(['status' => $validated['status']]);

        return back()->with('success', 'Task status updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('admin.tasks.index')->with('success', 'Task deleted successfully!');
    }
}