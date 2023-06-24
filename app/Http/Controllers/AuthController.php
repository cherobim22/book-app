<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

// php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
class AuthController extends Controller
{
    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email:rfc',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
           
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');    
            $user->password = Hash::make($request->input('password')); 
        
            
            $user->save();
        
            return response()->json(['success' => true], 201);
        
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            echo $e;
            return response()->json(['error' => 'Could not create token'], 500);
        }

        return response()->json(['token' => $token, " token_type" =>'bearer', "expires_in" =>  60]);
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return response()->json(['message' => 'Logged out']);
    }
}
