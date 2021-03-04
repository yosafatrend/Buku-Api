<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request){
        $password = $request->get('password');
        $data_user = array_merge($request->all(), [
            'password'=>Hash::make($password)
        ]);
        $user = User::create($data_user);

        return response()->json([
            'status'=> 1,
            'message'=>'Berhasil mendaftar',
            'user'=>$user
        ]);
    }

    public function login(Request $request){
        $email = $request->get('email');
        $password = $request->get('password');
        $user = User::where('email', $email)->first();
        $check_email_pass = Auth::attempt([
            'email' => $email, 'password' => $password
        ]);

        if($check_email_pass){
           return response()->json([
                'status' => 1,
                'message' => 'Login succcess',
                'user' => $user
           ]);
        }
        abort(401); //jika email pass salah
    }
}
