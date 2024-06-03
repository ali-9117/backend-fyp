<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function signup(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'customer'
        ]);


        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }


    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        return response()->json(['message' => 'User signed in successfully', 'user' => $user,'user_type' => $user->user_type,], 200);
    }

public function ForgetPassword(Request $request){


    $user = User::where('name', $request->name)
        ->where('email', $request->email)
        ->first();

      return response()->json(['success' => $user]);


}


    public function NewPassword(Request $request, $email)
    {
        $user = User::where('email', $email)
            ->first();

        if ($user) {
            $user->update(['password' => Hash::make($request->password)]);
            return response()->json(['success' => 'Password updated successfully'], 200);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }


    public function ChangePassword(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            return response()->json(['success' => $user]);
        } else
        {
          return response()->json(['error' => 'not found']);        }

    }


}
