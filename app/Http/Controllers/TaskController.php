<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tasks = Task::where('assigned_to', $user->id)->latest()->get();
        return view('user.my-tasks', compact('tasks'));
    }
    public function updateStatus(Request $request, $id)
    {
        $task = Task::where('id', $id)
            ->where('assigned_to', Auth::id())
            ->firstOrFail();

        $request->validate([
            'status' => 'required|in:To Do,In Progress,Done'
        ]);

        $task->status = $request->status;
        if ($request->status === 'Done') {
            $task->completed_date = now();
        } else {
            $task->completed_date = null;
        }
        $task->save();

        return response()->json(['success' => true, 'message' => 'Task status updated.']);
    }
}
