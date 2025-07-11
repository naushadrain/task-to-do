<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHomeCOntroller extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalTasks = Task::where('assigned_to', $user->id)->count();
        $pendingTasks = Task::where('assigned_to', $user->id)->where('status', '!=', 'Done')->count();
        $completedTasks = Task::where('assigned_to', $user->id)->where('status', 'Done')->count();
        $recentActivities = Task::where('assigned_to', $user->id)
            ->orderByDesc('updated_at')
            ->take(5)
            ->get();
        return view('user.user-dashboard', compact('totalTasks', 'pendingTasks', 'completedTasks','recentActivities'));
    }
}
