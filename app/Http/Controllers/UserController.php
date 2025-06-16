<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //registering new user that includes a succes message
    public function register(Request $request)
{
    $incomingFields = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed'
    ]);

    $user = User::create([
        'name' => $incomingFields['name'],
        'email' => $incomingFields['email'],
        'password' => Hash::make($incomingFields['password'])
    ]);

    Auth::login($user);
    return redirect('/')->with('success', 'Registration successful! Welcome to our blog!');
}
 //login success page
    public function login(Request $request)
{
    $incomingFields = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($incomingFields)) {
        $request->session()->regenerate();
        return redirect('/')->with('success', 'Login successful! Welcome back!');
    }

    return back()->withErrors(['email' => 'Invalid credentials.']);
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
