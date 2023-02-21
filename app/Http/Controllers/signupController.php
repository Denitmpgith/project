<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function index()
    {
        return view('verify.signup.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|unique:users,username|min:5|max:32',
            'password' => 'required|min:5|max:64|different:username',
            'cpassword' => 'required|same:password'
        ], [
            'cpassword.same' => 'The password confirmation does not match.'
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        // dd($validatedData);
        user::create($validatedData );
        // Lakukan operasi untuk menyimpan data ke database
        return redirect('/signin')->with('success', 'Registration successful!, Login Please !!');
    }
}
