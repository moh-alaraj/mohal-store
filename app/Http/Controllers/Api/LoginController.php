<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{
    public function logIn(Request $request){


        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'device_name' => ''
        ]);

//        $user = Auth::validate($request->only('email','password'));

           $user = User::where('email',$request->email)->first();

           if ($user && Hash::check($request->password , $user->password)){

               $device = $request->input('device_name', $request->userAgent());

               $token = $user->createToken($device,['products.create','products.update']);

               return Response::json([
                   'token' => $token->plainTextToken ,
               ]);


           }

            return Response::json([
                'message' => 'Invalid user'
            ],401 );
    }

    public function logout(Request $request){

        $user = Auth::guard('sanctum')->user();

        $user->currentAccessToken()->delete();

        return Response::json([
            'message' => 'token deleted '
        ],401 );

    }
}
