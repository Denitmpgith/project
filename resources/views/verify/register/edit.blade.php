@extends('template.main')

@section('container')
    <section class="">
        @if(session('failed'))
            <div class="alert alert-success col-span-12 text-white flex justify-center bg-neutral-700 rounded p-5">
                {{ session('failed') }}
            </div>
        @endif
        <div class="flex justify-start flex-col mt-3 w-full gap-3 bg-neutral-900 p-3 rounded shadow">
            <h1 class="text-white text-center capitalize">Edit Form</h1>
        </div>
        <form method="POST" action="{{ route('register.update', $user_details->id) }}">
            @csrf
            @method('PUT')
            <div class="flex justify-start flex-col mt-3 w-full gap-3 bg-neutral-900 p-5 rounded shadow">
                <span class="flex justify-start w-full">
                    <label for="first_name" class="text-white w-[150px]">First name</label>
                    <input id="first_name" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="first_name" type="text" placeholder="first name" value="{{ $user_details->first_name }}" autofocus>
                </span>
                <span class="flex justify-start w-full">
                    <label for="middle_name" class="text-white w-[150px]">Middle name</label>
                    <input id="middle_name" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="middle_name" type="text" placeholder="middle name" value="{{ $user_details->middle_name }}">
                </span>
                <span class="flex justify-start w-full">
                    <label for="last_name" class="text-white w-[150px]">Last name</label>
                    <input id="last_name" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="last_name" type="text" placeholder="last name" value="{{ $user_details->last_name }}">
                </span>
                <span class="flex justify-start w-full">
                    <label for="gender" class="text-white w-[150px]">Gender</label>
                    <select id="gender" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="gender">
                        <option value="male" {{ $user_details->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $user_details->gender == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </span>
                <span class="flex justify-start w-full">
                    <label for="job_status" class="text-white w-[150px]">Job status</label>
                    <input id="job_status" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="job_status" type="text" placeholder="job status" value="{{ $user_details->job_status }}">
                </span>
                <span class="flex justify-start w-full">
                    <span class="flex justify-start w-full">
                        <label for="address" class="text-white w-[150px]">Address</label>
                        <input id="address" class="w-[650px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="address" type="text" placeholder="address" value="{{ $user_details->address }}">
                    </span>
                    <span class="flex justify-center w-full">
                        <label for="city" class="text-white w-[150px]">City</label>
                        <input id="city" class="w-[250px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="city" type="text" placeholder="city" value="{{ $user_details->city }}">
                    </span>
                    <span class="flex justify-center w-full">
                        <label for="state" class="text-white w-[150px]">City</label>
                        <input id="state" class="w-[250px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="state" type="text" placeholder="state" value="{{ $user_details->state }}">
                    </span>
                </span>
                <span class="flex justify-start w-full">
                    <label for="country" class="text-white w-[150px]">Country</label>
                    <input id="country" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="country" type="text" placeholder="country" value="{{ $user_details->country }}">
                </span>
                <span class="flex justify-start w-full">
                    <label for="m_phone" class="text-white w-[150px]">Mobile phone</label>
                    <input id="m_phone" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="m_phone" type="text" placeholder="mobile phone" value="{{ $user_details->m_phone }}">
                </span>
                <span class="flex justify-start w-full">
                    <label for="email" class="text-white w-[150px]">Email</label>
                    <input id="email" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="email" type="text"  placeholder="email" value="{{ $user_details->email }}">
                </span>
                <span class="flex justify-start w-full">
                    <label for="work_now" class="text-white w-[150px]">Work now</label>
                    <input id="work_now" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="work_now" type="text"  placeholder="work now" value="{{ $user_details->work_now }}">
                </span>
                <span class="flex justify-start w-full">
                    <label for="website" class="text-white w-[150px]">Website</label>
                    <input id="website" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="website" type="text" placeholder="website" value="{{ $user_details->website }}">
                </span>
                <span class="flex justify-start w-full">
                    <label for="hero" class="text-white w-[150px]">Hero</label>
                    <input id="hero" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="hero" type="text" placeholder="hero" value="{{ $user_details->hero }}">
                </span>
            </div>
            <div class="col-span-12 flex justify-end mt-2 gap-5">
                <button type="submit" class="mt-2 bg-neutral-800 text-center text-white rounded w-28 h-6 p-0 m-0 hover:bg-neutral-700">Submit</button>
            </div>
        </form>
    </section>
@endsection