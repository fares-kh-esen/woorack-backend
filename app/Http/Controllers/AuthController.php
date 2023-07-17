<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{



    public function login()
    {
        try {
            if (Auth::check() == false) {
                request()->validate([
                    'email' => 'required|email',
                    'password' => 'required',
                ]);

                if (!Auth::attempt(request()->only(['email', 'password']))) {
                    return response()->json([
                        'error' => true,
                        'message' => 'Email & Mot de passe non valides !',
                    ], 200);
                }
            }
            $user = User::where('email', request('email'))
                            ->first();


            return response()->json([
                'error' => false,
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'user' => $user,


            ], 200);
        } catch (\Throwable $th) {
            report($th);
            return response()->json([
                'error' => true,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
