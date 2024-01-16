<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserApiController extends Controller
{
    public function exams($text){
        $pas = Hash::make($text);
        return response()->json([
            'status' => true,
            'message' => $pas,
            'error_note' => null
        ], 200);
    }

    public function login(Request $request){
//        return $request;
        $request->validate([
            'phone' => 'required|numeric',
            'password' => 'required|string',
            'name' => 'required|string',
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'phone' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($request->name)->plainTextToken;
    }
}
