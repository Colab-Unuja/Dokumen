<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::guard('user')->check()) {
            $kategori = Auth::guard('user')->user()->kategori;
            if ($kategori === 'admin' && !$request->is('admin/*')) {
                return redirect()->route('admin.index');
            } elseif ($kategori === 'karyawan' && !$request->is('karyawan/*')) {
                return redirect()->route('karyawan.index');
            } elseif ($kategori === 'mahasiswa' && !$request->is('mahasiswa/*')) {
                return redirect()->route('mahasiswa.index');
            } elseif ($kategori === 'dosen' && !$request->is('dosen/*')) {
                return redirect()->route('dosen.index');
            }
        }
        return '';
    }

    public function login()
    {
        return view('login');
    }

    public function auth_login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $login = DB::table('user')->where('email', '=', $email)->where('status', 'active')->first();
        if ($login != null) {
            if (Hash::check($password, $login->password)) {
                if (Auth::guard('user')->attempt(['email' => $email, 'password' => $password, 'status' => 'active'])) {
                    return redirect()->intended(url('/'));
                } else {
                    return Redirect()->route('login')->withInput()->with('error', 'Email dan Password salah');
                }
            } else {
                return Redirect()->route('login')->withInput()->with('error', 'Email dan Password salah');
            }
        } else {
            return Redirect()->route('login')->withInput()->with('error', 'Email dan Password salah');
        }
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        session()->flush();
        return redirect()->route('index');
    }

    public function admin()
    {
        return view('admin.dashboard');
    }

    public function karyawan()
    {
        return '';
    }

    public function dosen()
    {
        return '';
    }

    public function mahasiswa()
    {
        return '';
    }
}
