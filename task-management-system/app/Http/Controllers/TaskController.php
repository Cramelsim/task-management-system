<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('tasks.index', [
            'tasks' => auth()->user()->tasks()->latest()->paginate(10)
        ]);
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    // public function updateStatus(Request $request, Task $task)
    // {
    //     $this->authorize('update', $task);
    //     $request->validate(['status' => 'required|in:Pending,In Progress,Completed']);
    //     $task->update(['status' => $request->status]);
    //     return back()->with('success', 'Status updated!');
    // }

    public function updateStatus(Request $request, Task $task)
    {
        $this->authorize('update', $task);
    
        $validated = $request->validate([
        'status' => 'required|in:Pending,In Progress,Completed'
        ]);

        $task->update($validated);

        return back()->with('success', 'Task status updated successfully!');
    }
    }