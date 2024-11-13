<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(){
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
}
