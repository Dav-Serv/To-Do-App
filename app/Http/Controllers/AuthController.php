<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $validateData = $request->validated();

        $id = DB::table('users')->insertGetId([
            'name'          => $validateData['name'],
            'email'         => $validateData['email'],
            'password'      => Hash::make($validateData['password']),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return response()->json([
            'success'       => true,
            'message'       => 'Register berhasil',
            'data'          => [
                'id'        => $id,
                'name'      => $validateData['name'],
                'email'     => $validateData['email']
            ]
        ], 201);
    }

    public function login(LoginRequest $request){
        $validateData = $request->validated();

        $user = DB::table('users')->where('email', $validateData['email'])->first();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak ditemukan'
            ], 404);
        }

        if (!Hash::check(
            $validateData['password'],
            $user->password
        )) {

            return response()->json([
                'success' => false,
                'message' => 'Password salah'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'token' => 'logged_in',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);
    }
}
