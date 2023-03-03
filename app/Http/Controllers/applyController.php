<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\user_detiles;
use Illuminate\Support\Facades\Auth;

class applyController extends Controller
{
    public function index()
    {
        var_dump($_GET);
    }
}