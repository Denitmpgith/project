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
use Intervention\Image\Image;
use Intervention\Image\Gd\Driver as GdDriver;



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
            $originalFilename = $request->file('filename')->getClientOriginalName();
            $extension = $request->file('filename')->getClientOriginalExtension();
            $filename = Str::random(40) . '.' . $extension;
            $path = $request->file('filename')->move(storage_path('app/public/post-images'), $filename);
            
            $size = getimagesize($path); // dapatkan ukuran gambar
            $width = $size[0];
            $height = $size[1];
            
            // cek rasio ukuran gambar
            if (!in_array($extension, ['jpg', 'png'])) {
                // Tolak file yang bukan jpg atau png
                unlink($path); // hapus file yang sudah di-upload
                return redirect()->back()->withErrors(['error' => 'File gambar harus jpg atau png']);
            } else if ($width != $height) {
                // Tolak gambar yang bukan rasio 1:1
                unlink($path); // hapus gambar yang sudah di-upload
                return redirect()->back()->withErrors(['error' => 'Ukuran gambar harus berupa rasio 1:1']);
            } else if ($width != 250 || $height != 250) {
                // Ubah ukuran gambar menjadi 250x250
                $new_image = imagecreatetruecolor(500, 500);
                if($extension == 'jpg') {
                    $image = imagecreatefromjpeg($path);
                } else if($extension == 'png') {
                    $image = imagecreatefrompng($path);
                }
                imagecopyresampled($new_image, $image, 0, 0, 0, 0, 500, 500, $width, $height);
                imagedestroy($image);
                imagejpeg($new_image, $path->getPathname(), 90);
                imagedestroy($new_image);
            }
            
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
        return redirect('/dashboard/' . $post->slug)->with('success', 'apply berhasil kirim');
    } 
}