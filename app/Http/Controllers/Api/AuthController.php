<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken('AuthToken')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Authenticated',
                'token' => $token,
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid credentials'], 401);
    }    

    public function logout()
    {
        Auth::logout();
        return response()->json(['status' => 'success', 'message' => 'Logged out']);
    }
}
