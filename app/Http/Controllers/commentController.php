<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\comment;
use App\Models\replyComment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class commentController extends Controller
{
    public function storeComment(Request $request)
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
            $slug = Str::snake($validatedData['comment']);
            $slug = substr($slug, 0, 40);
            $latestPost = comment::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->latest('id')->first();
            if($latestPost) {
                $latestSlug = $latestPost->slug;
                $pieces = explode('_', $latestSlug);
                $index = intval(end($pieces));
                $slug .= '_' . ($index + 1);
            }
        $comment->slug = $slug;
        // $request->all();
        $comment->save();

        return redirect()->back()->with('success', 'Comment berhasil dibuat');
    }
    
    public function storeReply(Request $request)
    {
        $validatedData = $request->validate([
            'replyComment' => 'required'
        ]);
    
        $comment = comment::findOrFail($request->input('comment_id'));
        $replyComment = new replyComment;
        $replyComment->created_at = Carbon::now();
        $replyComment->user_id = Auth::user()->id;
        $replyComment->comment_id = $comment->id;
        $replyComment->replycomment = $validatedData['replyComment'];

            $slug = Str::snake($validatedData['replyComment']);
            $latestApply = comment::whereRaw("slug RLIKE '^{$slug}(_[0-9]+)?$'")->latest('id')->first();
            if($latestApply) {
                $latestSlug = $latestApply->slug;
                $pieces = explode('_', $latestSlug);
                $index = intval(end($pieces));
                $slug .= '_' . ($index + 1);
            }
        $replyComment->slug = $slug;
        $replyComment->save();
        
        return redirect()->back()->with('success', 'Comment berhasil dibuat');
    }    
}
