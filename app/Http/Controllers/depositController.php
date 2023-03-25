<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class depositController extends Controller
{
    public function index($username)
    {
        $auth = auth()->user();
        return view('verify.deposit.index',[
            'auth' => $auth
        ]);
    }
}
