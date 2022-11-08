<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('userToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($fields)) {
            $user = User::where(['email' => $fields['email']])->firstOrFail();
            $token = $user->createToken($fields['password'])->plainTextToken;

            return [
                'user' => $user,
                'token' => $token
            ];
        }

        return response()->json([
            'status' => false,
            'message' => 'Email & Password does not match.',
        ], 401);
    }

    public function logout()
    {
        auth()->logout();

        return [
            'message'  => 'logged out',
            'success' => true
        ];
    }
}
