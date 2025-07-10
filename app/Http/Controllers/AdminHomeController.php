<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalTasks = Task::count();
        $pendingTasks = Task::where('status', 'To Do')->count();
        return view('admin.dashboard', compact('totalUsers','totalTasks','pendingTasks'));
    }
}
