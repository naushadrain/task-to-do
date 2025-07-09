<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginCredentialsController extends Controller
{
    public function index()
    {
        return view('welcome'); // login view
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $email = $request->input('login');
        $password = $request->input('password');

        // Check if user exists
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withInput()->with('error', 'No account found with this email address.');
        }

        // Check if blocked
        if ($user->status == 0) {
            return back()->withInput()->with('error', 'Your account has been blocked. Please contact the admin team.');
        }

        // Attempt login
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->regenerate();

            // ✅ Redirect based on role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role === 'user') {
                return redirect()->route('user.dashboard');
            } else {
                Auth::logout();
                return redirect()->route('login.index')->with('error', 'Unknown role. Access denied.');
            }
        }

        return back()->withInput()->with('error', 'Invalid email or password.');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // log out the user

        $request->session()->invalidate(); // invalidate session
        $request->session()->regenerateToken(); // regenerate CSRF token

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
