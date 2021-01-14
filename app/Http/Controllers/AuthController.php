<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->all())) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ]);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response()->json([
            'user' => auth()->user(),
            'access_token' => $accessToken
        ], 200);
    }
}
