<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\User_detiles;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user_detiles = User_detiles::where('user_id', $user->id)->first();
        $picture = '/default/potraid120x150.png';

        if ($user_detiles && $user_detiles->profile && file_exists(public_path('/img/' . $user_detiles->profile))) {
            $picture = '/img/' . $user_detiles->profile;
        } else {
            $picture = '/default/portrait120x150.png';
        }
      
        return view('user.index', [
            'user' => $user, 
            'picture' => $picture,
            'user_detiles' => $user_detiles
        ]);
    }
}
