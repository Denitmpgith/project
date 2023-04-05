@extends('template.main')
@section('container')
    <section>
        @if(session('failed'))
        <div class="alert alert-success col-span-12 text-white flex justify-center bg-neutral-700 rounded p-5">
            {{ session('failed') }}
        </div>
        @endif
        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="flex justify-start flex-col">
                <label for="first_name" class="text-white">First name</label>
                <input id="first_name" name="first_name" type="text" placeholder="first_name">
                <label for="middle_name" class="text-white">Middle name</label>
                <input id="middle_name" name="middle_name" type="text" placeholder="middle_name">
                <label for="last_name" class="text-white">Last name</label>
                <input id="last_name" name="last_name" type="text" placeholder="last_name">
                <label for="gender" class="text-white">Gender</label>
                <select id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <label for="job_status" class="text-white">Job status</label>
                <input id="job_status" name="job_status" type="text" placeholder="job_status">
                <label for="address" class="text-white">Address</label>
                <input id="address" name="address" type="text" placeholder="address">
                <label for="city" class="text-white">City</label>
                <input id="city" name="city" type="text" placeholder="city">
                <label for="country" class="text-white">Country</label>
                <input id="country" name="country" type="text" placeholder="country">
                <label for="m_phone" class="text-white">Mobile phone</label>
                <input id="m_phone" name="m_phone" type="text" placeholder="m_phone">
                <label for="email" class="text-white">Email</label>
                <input id="email" name="email" type="text" placeholder="email">
                <label for="work_now" class="text-white">Work now</label>
                <input id="work_now" name="work_now" type="text" placeholder="work_now">
                <label for="website" class="text-white">Website</label>
                <input id="website" name="website" type="text" placeholder="website">
                <label for="hero" class="text-white">Hero</label>
                <input id="hero" name="hero" type="text" placeholder="hero">
            </div>
            <button type="submit" class="mt-2 bg-neutral-800 text-center text-white rounded w-28 h-6 p-0 m-0 hover:bg-neutral-700">Submit</button>
        </form>
    </section>
@endsection
