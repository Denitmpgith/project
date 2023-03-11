<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class commentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'comment' => 'required'
        ]);

        $post = Post::findOrFail($request->input('post_id'));
        $comment = new comment;
        $comment->created_at = Carbon::now();
        $comment->post_id = $post->id;
        $comment->user_id = Auth::user()->id;
        $comment->comment = $validatedData['comment'];
            $slug = Str::slug($validatedData['comment']);
            $slug = substr($slug, 0, 40);
            $latestPost = comment::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->latest('id')->first();
            if($latestPost) {
                $latestSlug = $latestPost->slug;
                $pieces = explode('_', $latestSlug);
                $index = intval(end($pieces));
                $slug .= '_' . ($index + 1);
            }
        $comment->slug = $slug;
        $request->all();
        $comment->save();

        
        return redirect()->back()->with('success', 'Comment berhasil dibuat');
    }
}
