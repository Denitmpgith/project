<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Apply;
use App\Models\level;
use App\Models\comment;
use App\Models\postFile;
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
            
            $applyFile = $apply->applyFiles ? $apply->applyFiles->first() : null;
            $appliesData[] = array_merge($applyData, ['applyFile' => $applyFile]);
        }

        return view('user.show', [
            'post' => $post,
            'appliesData' => $appliesData,
        ], compact('post', 'user_detiles'));
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
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'deadline' => 'required|numeric',
    //         'title' => 'required|max:255',
    //         'reward' => 'required|numeric',
    //         'description' => 'required',
    //     ]);      

    //     // dd($validatedData);

    //     $user = Auth::user();
    //     $post = new Post;
    //     $post->user_id = $user->id;
    //     $post->deadline = time() + ($validatedData['deadline'] * 24 * 60 * 60);
    //     $post->title = $validatedData['title'];

    //     if ($validatedData['reward'] < 100) {
    //         $post->level = "Stone";
    //     } else if ($validatedData['reward'] < 200) {
    //         $post->level = "Bronze";
    //     } else if ($validatedData['reward'] < 300) {
    //         $post->level = "Silver";
    //     } else if ($validatedData['reward'] < 400) {
    //         $post->level = "Gold";
    //     } else if ($validatedData['reward'] < 500) {
    //         $post->level = "Platinum";
    //     } else {
    //         $post->level = "Diamond";
    //     }

    //     $post->reward = $validatedData['reward'];
    //         $slug = Str::snake($validatedData['title']);
    //         $latestPost = Post::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->latest('id')->first();
    //         if($latestPost) {
    //             $latestSlug = $latestPost->slug;
    //             $pieces = explode('_', $latestSlug);
    //             $index = intval(end($pieces));
    //             $slug .= '_' . ($index + 1);
    //         }
    //     $post->slug = $slug;
    //     $post->description = $validatedData['description'];
    //     $post->save();

    //     // Validasi request
    //     $request->validate([
    //         'input_file' => 'required|array|min:1',
    //         'input_file.*' => 'required|file|max:2048'
    //     ]);

    //     // Mengambil seluruh file yang diupload
    //     $files = $request->file('input_file');

    //     // Menambahkan setiap file dan deskripsi ke dalam database
    //     foreach ($files as $key => $file) {

    //         $extension = $request->file('filename')->getClientOriginalExtension();
    //         $filename = Str::random(40) . '.' . $extension;
    //         $path = $request->file('filename')->move(storage_path('app/public/post-images'), $filename);

    //         // Simpan file ke dalam direktori yang diinginkan
    //         $file->storeAs('public/post_files', $filename);

    //         // Membuat postFile baru
    //         $postFile = new postFile();
    //         $postFile->post_id = $post->id;
    //         $postFile->filename = $filename;
    //         $postFile->title = $request->input('description.' . $key);
    //         $postFile->save();
    //     }

    //     return redirect('/user')->with('success', 'Post berhasil dibuat');
    // }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'deadline' => 'required|numeric',
            'title' => 'required|max:255',
            'reward' => 'required|numeric',
            'description' => 'required',
        ]);

        $user = Auth::user();

        $post = new Post();
        $post->user_id = $user->id;
        $post->deadline = time() + ($validatedData['deadline'] * 24 * 60 * 60);
        $post->title = $validatedData['title'];

        if ($validatedData['reward'] < 100) {
            $post->level = "Stone";
        } else if ($validatedData['reward'] < 200) {
            $post->level = "Bronze";
        } else if ($validatedData['reward'] < 300) {
            $post->level = "Silver";
        } else if ($validatedData['reward'] < 400) {
            $post->level = "Gold";
        } else if ($validatedData['reward'] < 500) {
            $post->level = "Platinum";
        } else {
            $post->level = "Diamond";
        }

        $post->reward = $validatedData['reward'];
        $slug = Str::snake($validatedData['title']);
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

        // Validasi request
        $request->validate([
            'input_file' => 'nullable|array|min:1',
            'input_file.*' => 'required|file|max:1048'
        ]);

        if ($request->hasFile('input_file')) {
            // Mengambil seluruh file yang diupload
            $files = $request->file('input_file');
            // $extension = $request->file('input_file')->getClientOriginalExtension();
            // $filename = Str::random(40) . '.' . $extension;

            // Menambahkan setiap file dan deskripsi ke dalam database
            foreach ($files as $key => $file) {
                $extension = $file->getClientOriginalExtension(); // mengambil extension dari masing-masing file
                $filename = Str::random(40) . '.' . $extension;
                // Simpan file ke dalam direktori yang diinginkan
                $file->move(storage_path('app/public/post-images'), $filename);

                // Membuat postFile baru
                $postFile = new PostFile();
                $postFile->post_id = $post->id;
                $postFile->filename = $filename;
                $postFile->title = $request->input('file_description.' . $key);
                    $slug = Str::slug($validatedData['title']);
                        $latestPost = Post::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->latest('id')->first();
                        if ($latestPost) {
                            $latestSlug = $latestPost->slug;
                            $pieces = explode('-', $latestSlug);
                            $index = intval(end($pieces));
                            $slug .= '-' . ($index + 1);
                        }
                $postFile->slug = $slug;
                $postFile->save();
            }
        }

        return redirect('/user')->with('success', 'Post berhasil dibuat');
    }

}