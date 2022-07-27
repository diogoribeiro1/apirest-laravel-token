<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
//        $this

        if(!auth()->attempt($credentials))
            abort(401, 'Invalid Credentials');

        $token = auth()->user()->createToken('auth_token');

        return response()
            ->json([
                'data'=>[
                        'token'=> $token->plainTextToken
                ]
            ]);
    }

    function register(Request $request, User $user): JsonResponse
    {
        $userData = $request->only('name', 'email', 'password');
        $userData['password'] = bcrypt($userData['password']);

        if (!$user = $user->create($userData))
            abort(500, 'Error to create a new user...');

        return response()
            ->json([
                'data'=>[
                    'user'=> $user
                ]
            ]);
    }

    public function refresh(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'access_token' => $request->user()->createToken('api')->plainTextToken,
        ]);
    }

    public function logout(): array
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logout efetuado com sucesso e exclusão dos tokens.'
        ];
    }
}

