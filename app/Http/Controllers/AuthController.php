<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function showRegister(){
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $validateData = $request->validated();

        DB::table('users')->insert([
            'name'          => $validateData['name'],
            'email'         => $validateData['email'],
            'password'      => Hash::make($validateData['password']),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return redirect('/login')->with('success', 'Register berhasil');
    }

    public function login(LoginRequest $request){
        $validateData = $request->validated();

        $user = DB::table('users')->where('email', $validateData['email'])->first();

        if(!$user){
            return back()->with([
                'error' => 'Email tidak ditemukan'
            ]);
        }

        if (!Hash::check(
            $validateData['password'],
            $user->password
        )) {

            return back()->with([
                'error' => 'Password salah'
            ]);
        }

        session([
            'is_login'  => true,
            'user_id'   => $user->id,
            'user_name' => $user->name,
        ]);

        $request->session()->regenerate();

        return redirect('/tasks');
    }

    public function logout(){
        session()->flush();

        return redirect('/login')->with('success', 'Logout berhasil');
    }
}
