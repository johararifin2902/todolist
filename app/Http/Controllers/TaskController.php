<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('status', 'pending') 
            ->orderBy('deadline')
            ->orderBy('duration')  
            ->orderBy('priority')  
            ->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'priority' => 'required|in:1,2,3', 
            'deadline' => 'nullable|date',
        ]);

        Task::create([
            'task_name' => $request->task_name,
            'duration' => $request->duration,
            'priority' => $request->priority, 
            'deadline' => $request->deadline,
            'status' => 'pending', 
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task added successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
