<?php

namespace App\Http\Controllers;

use App\Models\Post;

class postController extends Controller
{
    public function index()
    {
        $posts = Post::with('applies','comments', 'comments.replyComments')->latest('id')->get();
        return view('post.index', compact('posts'));
    }
    public function show($slug)
    {
        $post = Post::with('user', 'user.user_detiles', 'user.apply.applyFile', 'applies', 'comments', 'comments.replyComments')
                    ->where('slug', $slug)
                    ->firstOrFail();
        return view('post.show', compact('post'));
    }
                    
}

