<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json(['message'=>'Email or password is wrong']);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['access_token'=>$token, 'user'=>$user]);
    }

    function register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed'
        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['access_token'=>$token, 'user'=>$user]);
    }
}
