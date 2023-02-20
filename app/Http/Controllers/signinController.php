<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class signinController extends Controller
{
    public function index()
    {
        return view('verify.signin.index');
    }
}
