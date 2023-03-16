<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User_detile;
use Illuminate\Http\Request;

class usagerController extends Controller
{
    public function showProfile($username)
    {
        $user = User::with('user_detiles')->where('username', $username)->firstOrFail();

        return view('usager.index', compact('user'));
    }
}
