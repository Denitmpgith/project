<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class signupController extends Controller
{
    public function index()
    {
        return view('verify.signup.index');
    }
}
