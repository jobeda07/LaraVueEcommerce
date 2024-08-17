<?php

namespace App\Http\Controllers\Backend\Auth;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return Inertia::render('Backend.auth.login');
    }

    public function checkLogin(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5|max:30',
        ], [
            'email.exists' => 'This email is not exists on user table',
        ]);

        $check = $request->only('email', 'password');

        if (Auth::attempt($check)) {
          //  $admin = Auth::user();
            return redirect()->route('admin.dashboard')->with('success', 'Welcome To Dashboard');
        } else {
            return redirect()->route('admin.login')->with('fail', 'Incorrect Credentials');
        }
    }
}
