<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Apply;
use App\Models\level;
use App\Models\postFile;
use Illuminate\Support\Str;
use App\Models\User_detiles;
use App\Models\Utransaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class usagerController extends Controller
{
    public function showProfile($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        if (!$user->user_detiles || !$user->user_detiles->first_name) {
            return redirect('/')->with('message', 'User yang Anda cari belum terdaftar!');
        }

        $appliesData = Apply::with('applyFile')
            ->whereHas('user', function ($query) use ($username) {
                $query->where('username', $username);
            })
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('usager.index', compact('user', 'appliesData'));
    }
}