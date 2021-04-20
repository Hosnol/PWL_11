<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\ApiRespone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiRespone;

    public function register(RegisterRequest $request)
    {
        $validated = $request->validate();
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return $this->apiSuccess([
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }
}
