<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $registerRequest) 
    {
        $userdata = $registerRequest->validated();
        $user = User::create([
            'name' => $userdata['name'],
            'username' => $userdata['username'],
            'email' => $userdata['email'],
            'password' => Hash::make($userdata['password']),
        ]);
        $token = $user->createToken('questionapp')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(LoginRequest $loginRequest) 
    {
        // Validate 
        $loginRequest->validated();

        // check user 
        $user = User::whereEmail($loginRequest->email)->first();

        if(!$user || ! Hash::check($loginRequest->password, $user->password)) {
            return response([
                'message' => "Invalid credentials"
            ], 422);
        }
        // create token

        $token = $user->createToken('questionapp')->plainTextToken;

        return response([
            'success' => true,
            'user' => $user,
            'token' => $token
        ], 200);
    }
}
