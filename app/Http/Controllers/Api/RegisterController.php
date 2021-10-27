<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class RegisterController extends Controller
{
    public function store(Request $request){

        $request->validate([
           'name' => 'required',
           'email' => 'required|unique:users' ,
            'password' => 'required',
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

//        $token = $user->createToken('register_token')->plainTextToken;

        return Response::json([
           'message' => 'user created succecfully',
           'data' => $user
        ]);

    }
}
