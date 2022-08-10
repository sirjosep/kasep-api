<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $user = new User;
        $user->nama =$request->nama;
        $user->email =$request->email;
        $user->password =$request->password;

        $sukses = 'Berhasil!';

        if ($register = User::where('email', $request->email)->first()){
            $result['pesan'] = "email sudah terdaftar";
            return response()->json($result);
        } else if($user){
            $user->save();
            return($user);
        } 
    }

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        if($login = User::where('email', $email)->where('password', $password)->first()){
                $result['id_user'] = $login->id_user;
                $result['email'] = $login->email;
                return response()->json($result);
        } else if ($login = !User::where('email', $email)->first()){
            $result['pesan'] = "email tidak terdaftar atau tidak sesuai";
            return response()->json($result);
        } else if ($login = !User::where('password', $password)->first()){
            $result['pesan'] = "password salah";
            return response()->json($result);
        }
    }

    public function logout(Request $request){
        $logout = $request->user();
        return response()->json([
         'message' => 'logout successfully'
     ]);
     }
}
