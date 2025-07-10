<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->orderBy('name', 'asc')->get();
        return view('admin.manage-users', compact('users'));
    }

    public function toggleStatus(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        // Update status
        $user->status = $request->status;
        $user->save();

        return response()->json([
            'success' => true,
            'new_status' => $user->status,
            'new_status_text' => $user->status == 1 ? 'Active' : 'Inactive',
        ]);
    }
}
