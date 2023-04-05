<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class signinController extends Controller
{
    public function index()
    {
        return view('verify.signin.index');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $userDetails = $user->user_detiles;
    
            if (!$userDetails || !$userDetails->first_name || !$userDetails->last_name || !$userDetails->address) {
                return redirect()->route('register');
            }
    
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
    
        return back()->with('loginError', 'Login failed !!');
    }    
    public function logout()
    {
        Auth::logout();
        Request()->session()->invalidate();
        Request()->session()->regenerateToken();
        return redirect('/');
    }
}
