<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function register(UserRequest $request){

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => md5($request['password']),
        ]);

        Auth::login($user);
        $token = $user->createToken('primeirotoken')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function login(UserLoginRequest $request){

        $user = User::where(['email'=> $request['email']])->where(['password'=>md5($request['password'])])->first();
        die('entrei no login');
        Auth::login($user);
        $token = $user->createToken('primeirotoken')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * Logout do usuário
     */
    public function logout(Request $request)
    {
        Auth::user()?->tokens()->delete();

        return ['success' => true];
    }
}

