<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }
    public function getRegister()
    {
        return view('auth.register');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $validated = auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,

        ]);
        if ($validated) {
            return redirect()->route('dashboard')->with('message', 'Welcome');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }

    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email',


            'password' => 'required|string|min:7|confirmed',
        ]);
        $user = User::create([
            'username' => $data['username'],

            'email' => $data['email'],

            'password' => bcrypt($data['password'])

        ]);
        //$token = $user->createToken('myapptoken')->plainTextToken;

        return redirect()->route('dashboard')->with('message', 'Welcome');
    }
}
