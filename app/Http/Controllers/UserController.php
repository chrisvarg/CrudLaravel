<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show User
    public function index()
    {
        $users = User::latest()->get();
        return view('users.index', [
            'users' => $users
        ]);
    }
    
    // Create User
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return back();
    }

    // Delete User
    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }

}
