<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class postController extends Controller
{
    public function index()
    {
        $posts = Post::with('applies','comments', 'comments.replyComments')->latest('id')->get();
        return view('post.index', compact('posts'));
    }
    public function show($slug)
    {
        $auth = auth()->user();
        $post = Post::with('user', 'user.user_detiles', 'user.apply.applyFile', 'applies', 'comments', 'comments.replyComments')
                    ->where('slug', $slug)
                    ->firstOrFail();
        $owner = User::find($post->user_id);
    
        $applies = $post->applies->sortBy(function ($apply) {
            return $apply->rate_status == 'Winner' ? 3 : ($apply->rate_status == 'Runner Up' ? 2 : ($apply->rate_status == 'norate' ? 1 : 0));
        })->reverse();
    
        $appliesData = [];
    
        foreach ($applies as $apply) {
            $applyData = [
                'rateStatus' => $apply->rate_status,
                'title' => Str::limit($apply->title, 25),
                'userFirstName' => $apply->user->user_detiles->first_name ?? 'not registered',
                'createdAt' => $post->created_at->diffForHumans(),
                'applyFileCount' => $apply->applyFile->count(),
            ];
    
            switch ($apply->rate_status) {
                case 'Winner':
                    $applyData['reward'] = number_format(floor($post->reward/100*70/$post->applies->where('rate_status', 'Winner')->count() * 100) / 100, 0, '.', '');
                    $applyData['color'] = 'green-600';
                    break;
                case 'Runner Up':
                    $applyData['reward'] = number_format(floor($post->reward/100*30/$post->applies->where('rate_status', 'Runner Up')->count() * 100) / 100, 0, '.', '');
                    $applyData['color'] = 'yellow-600';
                    break;
                case 'norate':
                    // $applyData['reward'] = number_format(floor($post->reward/100*10/$post->applies->where('rate_status', 'norate')->count() * 100) / 100, 0, '.', '');
                    $applyData['color'] = 'black';
                    break;
                case 'Reject':
                    $applyData['color'] = 'red-600';
                    break;
            }
    
            $appliesData[] = $applyData;
        }
    
        return view('post.show', [
            'post' => $post,
            'appliesData' => $appliesData,
        ]);
    }
}