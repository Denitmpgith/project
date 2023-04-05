<?php

namespace App\Http\Middleware;

use App\Models\user_detiles;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserDetileIsFilled
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
    
        // Ambil detail pengguna terkait (jika ada)
        $user_detile = $user->user_detiles;
    
        // Cek apakah detail pengguna sudah diisi
        if ($user_detile && $user_detile->first_name !== null) {
            // Jika detail pengguna sudah diisi, maka lanjutkan ke request selanjutnya
            return $next($request);
        }
    
        // Jika detail pengguna belum diisi, maka arahkan ke halaman untuk mengisi data
        return redirect()->route('register')->withErrors([
            'failed' => 'Mohon isi data diri terlebih dahulu sebelum melanjutkan'
        ]);
    }
    
}
