<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Apply;
use App\Models\User_detiles;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user_detiles = User_detiles::where('user_id', $user->id)->first();
        $posts = Post::where('user_id', $user->id)->latest('id')->paginate(5);
        $applies = Apply::where('user_id', $user->id)->latest('id')->paginate(5);
        $picture = '/default/potraid120x150.png';
    
        if ($user_detiles && $user_detiles->profile && file_exists(public_path('/img/' . $user_detiles->profile))) {
            $picture = '/img/' . $user_detiles->profile;
        } else {
            $picture = '/default/portrait120x150.png';
        }
    
        return view('user.index', [
            'posts' => $posts, 
            'user' => $user, 
            'picture' => $picture,
            'applies' => $applies,
            'user_detiles' => $user_detiles
        ]);
    }
    public function show($slug)
    {
        $user = Auth::user();
        $user_detiles = User_detiles::where('user_id', $user->id)->first();
        $post = Post::with('user', 'user.user_detiles', 'user.apply.applyFile', 'applies', 'comments', 'comments.replyComments')
                    ->where('user_id', $user->id)
                    ->where('slug', $slug)
                    ->firstOrFail();
        
        $picture = '/default/potraid120x150.png';
        
        if ($user_detiles && $user_detiles->profile && file_exists(public_path('/img/' . $user_detiles->profile))) {
            $picture = '/img/' . $user_detiles->profile;
        } else {
            $picture = '/default/portrait120x150.png';
        }

        return view('user.show', compact('post', 'picture', 'user_detiles'));
    }
}
