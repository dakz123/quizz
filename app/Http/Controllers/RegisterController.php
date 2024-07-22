<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function getRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $data['name'],

            'email' => $data['email'],

            'password' => bcrypt($data['password'])


        ]);
        auth()->login($user);
        //$token = $user->createToken('myapptoken')->plainTextToken;

        return redirect()->route('quiz.index')->with('message', 'Welcome');
    }
}
