<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Apply;
use App\Models\level;
use Illuminate\Support\Str;
use App\Models\User_detiles;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
    public function create()
    {
        $levelObj = new Level();
        $levels = $levelObj->level();
        $auth = Auth::user();
        $user_detiles = User_detiles::where('user_id', Auth::user()->id)->first();
        $picture = '/default/potraid120x150.png';
        
        if ($user_detiles && $user_detiles->profile && file_exists(public_path('/img/' . $user_detiles->profile))) {
            $picture = '/img/' . $user_detiles->profile;
        } else {
            $picture = '/default/portrait120x150.png';
        }
        return view('user.create',[
            'levels' => $levels,
            'auth' => $auth,
            'picture' => $picture,
            'user_detiles' => $user_detiles
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'deadline' => 'required|numeric',
            'level' => 'required',
            'title' => 'required',
            'reward' => 'required|numeric',
            'description' => 'required',
        ]);      

        // dd($validatedData);

        $user = Auth::user();
        $post = new Post;
        $post->user_id = $user->id;
        $post->deadline = time() + ($validatedData['deadline'] * 24 * 60 * 60);
        $post->level = $validatedData['level'];
        $post->title = $validatedData['title'];
        $post->reward = $validatedData['reward'];
            $slug = Str::slug($validatedData['title']);
            $latestPost = Post::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->latest('id')->first();
            if($latestPost) {
                $latestSlug = $latestPost->slug;
                $pieces = explode('_', $latestSlug);
                $index = intval(end($pieces));
                $slug .= '_' . ($index + 1);
            }
        $post->slug = $slug;
        $post->description = $validatedData['description'];
        $post->save();

        return redirect('/user')->with('success', 'Post berhasil dibuat');
    }
    public function apply($slug)
    {
        $user = Auth::user();
        $user_detiles = User_detiles::where('user_id', $user->id)->first();
        $apply = Apply::where('slug', $slug)->first();
        $picture = '/default/potraid120x150.png';
        
        if ($user_detiles && $user_detiles->profile && file_exists(public_path('/img/' . $user_detiles->profile))) {
            $picture = '/img/' . $user_detiles->profile;
        } else {
            $picture = '/default/portrait120x150.png';
        }
        return view('user.applydetile', [
            'picture' => $picture,
            'apply' => $apply,
            'user_detiles' => $user_detiles
        ]);
    }
}



