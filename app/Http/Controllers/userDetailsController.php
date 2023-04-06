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
            'user' => $user, 
            'user_details' => $user_details
        ]);        
    }    
    public function store(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Validasi input dari form
        $request->validate([
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'gender' => 'nullable|in:male,female',
            'job_status' => 'nullable|string|max:100',
            'address1' => 'nullable|string|max:255',
            'city1' => 'nullable|string|max:100',
            'state1' => 'nullable|string|max:100',
            'country1' => 'nullable|string|max:100',
            'm_phone1' => 'nullable|string|max:25',
            'email1' => 'nullable|string|email|max:100',
            'address2' => 'nullable|string|max:255',
            'city2' => 'nullable|string|max:100',
            'state2' => 'nullable|string|max:100',
            'country2' => 'nullable|string|max:100',
            'm_phone2' => 'nullable|string|max:25',
            'email2' => 'nullable|string|email|max:100',
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
        $userDetail->address1 = $request->input('address1');
        $userDetail->city1 = $request->input('city1');
        $userDetail->state1 = $request->input('state1');
        $userDetail->country1 = $request->input('country1');
        $userDetail->m_phone1 = $request->input('m_phone1');
        $userDetail->email1 = $request->input('email1');
        $userDetail->address2 = $request->input('address2');
        $userDetail->city2 = $request->input('city2');
        $userDetail->state2 = $request->input('state2');
        $userDetail->country2 = $request->input('country2');
        $userDetail->m_phone2 = $request->input('m_phone2');
        $userDetail->email2 = $request->input('email2');
        $userDetail->work_now = $request->input('work_now');
        $userDetail->website = $request->input('website');
        $userDetail->hero = $request->input('hero');
        $userDetail->save();

        // Redirect ke halaman dashboard dan tampilkan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Thank you for filling in the registration data');
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
            'address1' => 'nullable|string|max:255',
            'city1' => 'nullable|string|max:100',
            'state1' => 'nullable|string|max:100',
            'country1' => 'nullable|string|max:100',
            'm_phone1' => 'nullable|string|max:25',
            'email1' => 'nullable|string|email|max:100',
            'address2' => 'nullable|string|max:255',
            'city2' => 'nullable|string|max:100',
            'state2' => 'nullable|string|max:100',
            'country2' => 'nullable|string|max:100',
            'm_phone2' => 'nullable|string|max:25',
            'email2' => 'nullable|string|email|max:100',
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
            'address1',
            'city1',
            'state1',
            'country1',
            'm_phone1',
            'email1',
            'address2',
            'city2',
            'state2',
            'country2',
            'm_phone2',
            'email2',
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
