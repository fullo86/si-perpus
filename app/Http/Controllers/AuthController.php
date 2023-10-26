<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username'  => ['required'],
            'password'  => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            //Cek status user apakah masih tidak aktif
            if (Auth::user()->status != 'active') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
        
                Session::flash('status', 'failed');
                Session::flash('message', 'Akun Anda Belum Aktif');
                return redirect('/login');
            }

            //cek login role user = admin
            $request->session()->regenerate();
            if (Auth::user()->role_id  == 1) {
                return redirect('/dashboard');
            }

            //cek login role user = member
            if (Auth::user()->role_id == 2) {
                return redirect('/dashboards');
            }
        }
        Session::flash('status', 'failed');
        Session::flash('message', 'Login Gagal');
        return redirect('/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registUser(RegisterRequest $request)
    {
        //validation unik username & email
        $request->validate([
            'username'  => 'unique:users',
            'email'     => 'unique:users'
        ]);

        //hash password
        $request['password'] = Hash::make($request->password);
        $request['image_user'] = 'default.png';
        $data = User::create($request->all());
        if ($data) {
            Session::flash('status', 'success');
            Session::flash('message', 'Registrasi Berhasil');
        }
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
