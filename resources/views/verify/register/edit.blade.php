@extends('template.main')

@section('container')
    <section>
        @if(session('failed'))
            <div class="alert alert-success col-span-12 text-white flex justify-center bg-neutral-700 rounded p-5">
                {{ session('failed') }}
            </div>
        @endif
        <form method="POST" action="{{ route('register.update', $user_details->id) }}">
            @csrf
            @method('PUT')
            <div class="flex justify-start flex-col">
                <label for="first_name" class="text-white">First name</label>
                <input id="first_name" name="first_name" type="text" value="{{ $user_details->first_name }}">
                <label for="middle_name" class="text-white">Middle name</label>
                <input id="middle_name" name="middle_name" type="text" value="{{ $user_details->middle_name }}">
                <label for="last_name" class="text-white">Last name</label>
                <input id="last_name" name="last_name" type="text" value="{{ $user_details->last_name }}">
                <label for="gender" class="text-white">Gender</label>
                <select id="gender" name="gender">
                    <option value="male" {{ $user_details->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $user_details->gender == 'female' ? 'selected' : '' }}>Female</option>
                </select>
                <label for="job_status" class="text-white">Job status</label>
                <input id="job_status" name="job_status" type="text" value="{{ $user_details->job_status }}">
                <label for="address" class="text-white">Address</label>
                <input id="address" name="address" type="text" value="{{ $user_details->address }}">
                <label for="city" class="text-white">City</label>
                <input id="city" name="city" type="text" value="{{ $user_details->city }}">
                <label for="country" class="text-white">Country</label>
                <input id="country" name="country" type="text" value="{{ $user_details->country }}">
                <label for="m_phone" class="text-white">Mobile phone</label>
                <input id="m_phone" name="m_phone" type="text" value="{{ $user_details->m_phone }}">
                <label for="email" class="text-white">Email</label>
                <input id="email" name="email" type="text" value="{{ $user_details->email }}">
                <label for="work_now" class="text-white">Work now</label>
                <input id="work_now" name="work_now" type="text" value="{{ $user_details->work_now }}">
                <label for="website" class="text-white">Website</label>
                <input id="website" name="website" type="text" value="{{ $user_details->website }}">
                <label for="hero" class="text-white">Hero</label>
                <input id="hero" name="hero" type="text" value="{{ $user_details->hero }}">
            </div>
            <button type="submit" class="mt-2 bg-neutral-800 text-center text-white rounded w-28 h-6 p-0 m-0 hover:bg-neutral-700">Submit</button>
        </form>
    </section>
@endsection
``
