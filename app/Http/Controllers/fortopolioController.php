<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class fortopolioController extends Controller
{
    public function index()
    {
        return view('fortopolio.index');
    }
}
