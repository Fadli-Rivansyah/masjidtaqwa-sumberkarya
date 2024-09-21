<?php

namespace App\Http\Controllers\auth;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function enterDashboard(Request $request)
    {
        $credential = $request->validate(
            [
                "username" => "required",
                "password" => "required" 
            ],[
                "username.required" => "Masukan username dengan benar!",
                "password.required" => "Masukan password dengan benar!"
            ]);
        if(Auth::attempt($credential)){
            $request->session()->regenerate();
            // jika berhasil masuk
            return redirect()->route('dashboard');
        }
        return back()->with('error', 'Login Gagal!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('page_home');
    }
}