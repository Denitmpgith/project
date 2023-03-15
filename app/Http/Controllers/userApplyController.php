<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Models\ApplyFile;
use App\Models\User_detiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userApplyController extends Controller
{
    public function index($slug)
    {
        $apply = Apply::where('slug', $slug)->firstOrFail();
        $applyfiles = ApplyFile::where('apply_id', $apply->id)->get();
    
        $files = [];
        foreach($applyfiles as $file) {
            $filename = $file->filename;
            $filepath = "/storage/post-images/$filename";
            $files[] = [
                'title' => $file->title,
                'image' => asset($filepath)
            ];
        }
        
        // dd($files);
    
        return view ('user.userapply', [
            'apply' => $apply,
            'applyfiles' => $files // mengirimkan data yang sudah di-loop ke view
        ]);
    }
    
}
