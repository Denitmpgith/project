<?php

namespace App\Http\Controllers;

use App\Models\user_detiles;
use Illuminate\Http\Request;

class userDetailsController extends Controller
{
    public function create()
    {        
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }
    
        $user_details = user_detiles::where('user_id', $user->id)->first();
        if($user_details && $user_details->first_name != null && $user_details->first_name != ''){
            return redirect()->route('editData');
        }
    
        return view('verify.register.index', [
            'user_details' => $user_details
        ]);        
    }    
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'gender' => 'nullable|in:male,female',
            'job_status' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'm_phone' => 'nullable|string|max:25',
            'email' => 'nullable|string|email|max:100',
            'work_now' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'hero' => 'nullable|string|max:255',
        ]);

        // Buat objek model UserDetail dengan data dari input form
        $userDetail = new user_detiles;
        $userDetail->user_id = auth()->user()->id;
        $userDetail->profile = '';
        $userDetail->first_name = $request->input('first_name');
        $userDetail->middle_name = $request->input('middle_name');
        $userDetail->last_name = $request->input('last_name');
        $userDetail->gender = $request->input('gender');
        $userDetail->job_status = $request->filled('job_status') ? $request->job_status : 'Freelancer';
        $userDetail->address = $request->input('address');
        $userDetail->city = $request->input('city');
        $userDetail->country = $request->input('country');
        $userDetail->m_phone = $request->input('m_phone');
        $userDetail->email = $request->input('email');
        $userDetail->work_now = $request->input('work_now');
        $userDetail->website = $request->input('website');
        $userDetail->hero = $request->input('hero');
        $userDetail->save();

        // Redirect ke halaman dashboard dan tampilkan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Thank you for filling out the user registration form. Please feel free to continue to other tabs that you desire.');
    }
    public function edit()
    {
        $user_detiles = user_detiles::where('user_id', auth()->user()->id)->first();

        return view('verify.register.edit', [
            'user_details' => $user_detiles
        ]);
    }

    public function update(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'gender' => 'nullable|in:male,female',
            'job_status' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'm_phone' => 'nullable|string|max:25',
            'email' => 'nullable|string|email|max:100',
            'work_now' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'hero' => 'nullable|string|max:255',
        ]);

        // Ambil data user details dari database
        $userDetail = user_detiles::where('user_id', auth()->user()->id)->first();

        // Update data user details
        $userData = $request->only([
            'first_name',
            'middle_name',
            'last_name',
            'gender',
            'job_status',
            'address',
            'city',
            'country',
            'm_phone',
            'email',
            'work_now',
            'website',
            'hero'
        ]);
        
        foreach ($userData as $key => $value) {
            if ($value !== null && $userDetail->$key !== $value) {
                $userDetail->$key = $value;
            }
        }
        
        $userDetail->save();

        // Redirect ke halaman dashboard dan tampilkan pesan sukses
        return redirect()->route('dashboard')->with('success', 'User details updated successfully!');
    }
}