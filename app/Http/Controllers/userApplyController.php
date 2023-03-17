<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
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
        $user = $apply->user;
        $applyfiles = ApplyFile::where('apply_id', $apply->id)->get();
        
        $files = [];
        foreach($applyfiles as $file) {
            $filename = $file->filename;
            $filepath = "/storage/post-images/$filename";
            $files[] = [
                'user' => $user,
                'title' => $file->title,
                'image' => asset($filepath)
            ];
        }
        
        $winners = Apply::select(DB::raw('count(*) as total, post_id'))
                        ->where('rate_status', 'Winner')
                        ->groupBy('post_id')
                        ->get();
        
        $totalWinners = $winners->where('post_id', $apply->post_id)->sum('total');

        $runnerup = Apply::select(DB::raw('count(*) as total, post_id'))
                        ->where('rate_status', 'Runner Up')
                        ->groupBy('post_id')
                        ->get();

        $totalRunnerUp = $runnerup->where('post_id', $apply->post_id)->sum('total');

        return view ('user.userapply', [
            'user' => $user,
            'apply' => $apply,
            'applyfiles' => $files,
            'winners' => $winners,
            'totalWinners' => $totalWinners,
            'totalRunnerUp' => $totalRunnerUp
        ]);        
    }

    public function userapplystore(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'submit' => 'required|in:Winner,Runner Up,Reject,norate'
        ]);
    
        // dd($validatedData); // Tambahkan kode ini untuk menampilkan data yang sudah ditangkap
    
        $apply = Apply::where('slug', $slug)->firstOrFail();
        if ($apply->rate_status) {
            $apply->rate_status = $validatedData['submit'];
            $apply->save();
        }
        
        return redirect('/user/' . $apply->post->slug)->with('success', 'Successfully updated apply status.');
    }
    
}

