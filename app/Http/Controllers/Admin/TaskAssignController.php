<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskAssignController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get(); // or use Spatie's ->role('user')
        return view('admin.assign-task', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'status' => 'required|string',
            'assigned_to' => 'required|exists:users,id',
            'completed_date' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $task = new Task();
        $task->description = $request->description;
        $task->status = $request->status;
        $task->assigned_to = $request->assigned_to;
        $task->created_by = Auth::id();
        $task->assigned_date = now();
        $task->completed_date = $request->completed_date;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('task_images', 'public');
            $task->image = $path;
        }

        $task->save();

        return redirect()->back()->with('success', 'Task assigned successfully!');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $users = User::where('role', 'user')->get();
        return view('admin.edit-task', compact('task', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string',
            'status' => 'required|string',
            'assigned_to' => 'required|exists:users,id',
            'due_date' => 'nullable|date',
            'priority' => 'required|string',
        ]);

        $task = Task::findOrFail($id);
        $task->description = $request->description;
        $task->status = $request->status;
        $task->assigned_to = $request->assigned_to;
        $task->assigned_date = now();
        $task->due_date = $request->due_date;
        $task->priority = $request->priority;
        $task->save();

        return redirect()->route('all.task.index')->with('success', 'Task updated successfully!');
    }
}
