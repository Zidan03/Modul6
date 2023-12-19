<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(AuthRequest $request) {
        try {
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => $request->password
            ]);

            return response()->json([
                "message" => "Success",
                "data" => $user
            ], 200);

        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }

    }

    public function login(AuthRequest $request) {
        try {
            $user = User::where("email", $request->email)->first();
            if($user) {
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    "message" => "Success",
                    "token_type" => "Bearer",
                    "access_token" => $token
                ], 200);
            } else {
                return response()->json([
                    "message" => "Failed",
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function logout() {
        try {
            Auth::user()->tokens()->delete();

            return response()->json([
                "message" => "Success",
            ], 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}