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
        return view('admin.view-all-task',compact('tasks'));
    }
}
