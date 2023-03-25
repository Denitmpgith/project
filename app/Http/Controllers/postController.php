<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Apply;
use App\Models\applyFile;
use App\Models\postFile;
use Illuminate\Support\Str;
use App\Models\User_detiles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class postController extends Controller
{
    public function index()
    {
        $posts = Post::with('applies', 'comments', 'comments.replyComments')->latest('id')->get();
        $postLevels = Post::pluck('level')->toArray();
            
        // dd($postLevels); // tambahkan baris ini untuk mencetak nilai variabel
    
        return view('post.index', [
            'posts' => $posts,
            // 'class' => $class,
        ]);
    }
    

    public function show($slug)
    {
        $user = Auth::user();
        $user_detiles = User_detiles::where('user_id', $user->id)->first();
        $post = Post::with('user', 'user.user_detiles', 'user.apply.applyFile', 'applies', 'comments', 'comments.replyComments', 'postFile')
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
                'applyFileCount' => $apply->applyFile ? $apply->applyFile->count() : 0,
                'applyFileName' => $apply->applyFile->pluck('filename')->toArray(),
                'slug' => $apply->slug,
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
            
            $applyFile = applyFile::where('apply_id', $apply->id)->first();
            // $applyFile = $apply->applyFiles ? $apply->applyFiles->first() : null;
            $appliesData[] = array_merge($applyData, ['applyFile' => $applyFile]);
        }

        return view('post.show', [
            'post' => $post,
            'appliesData' => $appliesData,
        ], compact('post', 'user_detiles'));
    }
}