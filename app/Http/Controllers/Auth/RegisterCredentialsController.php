<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

use function Laravel\Prompts\password;

class RegisterCredentialsController extends Controller
{
    public function index()
    {

        return view('register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
            'number' => 'nullable|numeric|digits_between:10,15',
            'gender' => 'nullable|in:Male,Female,Other',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('profile')) {
            $imagePath = $request->file('profile')->storeAs('profile_folder', time() . '.' . $request->file('profile')->getClientOriginalExtension(), 'public');
        }

        $user = User::create([
            'name' => strip_tags($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'number' => $request->number,
            'gender' => $request->gender,
            'profile_image' => $imagePath,
            'status' => 1,
            'role' => 'user'
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Registration successful!');
    }
}
