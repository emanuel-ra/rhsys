<?php

namespace App\Http\Controllers\AuthApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        if(!Auth::attempt($request->only('email','password')))
        {
            return response()->json(['message'=>'Unauthorized'],401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Hi '.$user->name ,
            'accessToken' => $token ,
            'token_type' => 'Bearer' ,
            'user' => $user 
        ]);
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message'=>'You have successfully logged out and the token was successfully deleted'],200);
    }
}
