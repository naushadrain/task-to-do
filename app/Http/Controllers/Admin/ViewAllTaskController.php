<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class ViewAllTaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['creator', 'assignee'])->latest()->get();
        return view('admin.view-all-task', compact('tasks'));
    }

    public function search(Request $request)
    {
        $query = $request->query('query');

        $tasks = Task::with(['creator', 'assignee'])
            ->where('description', 'like', "%$query%")
            ->orWhere('status', 'like', "%$query%")
            ->orWhereHas('creator', fn($q) => $q->where('name', 'like', "%$query%"))
            ->orWhereHas('assignee', fn($q) => $q->where('name', 'like', "%$query%"))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.partials.task-table', compact('tasks'))->render();
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
}
