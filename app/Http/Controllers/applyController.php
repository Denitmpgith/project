<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Apply;
use App\Models\Applyfile;
use App\Models\user_detiles;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class applyController extends Controller
{
    public function index()
    {
        echo "applyController/index";
    }
    public function create($slug)
    {
        $user = Auth::user();
        $apply = Apply::where('user_id', $user->id)->first();
        $post = Post::with('user', 'user.user_detiles', 'applies', 'user.apply.applyFile')
                    ->where('slug', $slug)
                    ->firstOrFail();
    
        return view('apply.create', [
            'post' => $post,
            'apply' => $apply
        ]);
    }

    public function store(Request $request)
    {
        // ddd($request);
        // return $request->file('filename')->store('post-images');
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'filename' => 'required',
            'aftitle' => 'required',
    
        ]);
    
        $user = Auth::user();
        $post = Post::where('slug', $request->slug)->firstOrFail();
    
        $apply = new Apply;
        $apply->post_id = $post->id;
        $apply->user_id = Auth::user()->id;
        $apply->title = $validatedData['title'];
            $slug = Str::snake($validatedData['title']);
            $latestApply = Apply::whereRaw("slug RLIKE '^{$slug}(_[0-9]+)?$'")->latest('id')->first();
            if($latestApply) {
                $latestSlug = $latestApply->slug;
                $pieces = explode('_', $latestSlug);
                $index = intval(end($pieces));
                $slug .= '_' . ($index + 1);
            }
        $apply->slug = $slug;
        $apply->description = $validatedData['description'];
        $apply->rate_status = 'norate';
        $apply->save();
    
        $file = $request->file('filename');
        $applyFile = null;
        if ($request->hasFile('filename') && $request->file('filename')->isValid()) {
            $filename = time() . '_' . $request->file('filename')->getClientOriginalName();
            $path = $request->file('filename')->store('post-images');        
    
            $applyFile = new ApplyFile;
            $applyFile->apply_id = $apply->id;
            $applyFile->filename = $filename;
            $applyFile->title = $validatedData['aftitle'];
                $slug = Str::snake($validatedData['aftitle']);
                $latestApply = Apply::whereRaw("slug RLIKE '^{$slug}(_[0-9]+)?$'")->latest('id')->first();
                if($latestApply) {
                    $latestSlug = $latestApply->slug;
                    $pieces = explode('_', $latestSlug);
                    $index = intval(end($pieces));
                    $slug .= '_' . ($index + 1);
                }
            $applyFile->slug = $slug;
            $applyFile->save();
        } else {
            // Handle error when file is not found or invalid
        }
        
        // dd($applyFile);
        // dd($validatedData, $apply, $applyFile);
    
        return redirect('/dashboard/' . $post->slug)->with('success', 'apply berhasil kirim');
    } 
}