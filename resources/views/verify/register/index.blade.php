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
            <div class="flex justify-start flex-col mt-3 w-full gap-3 bg-neutral-900 p-5 rounded shadow">
                <span class="flex justify-start w-full">
                    <label for="first_name" class="text-white w-[150px]">First name</label>
                    <div class="flex justify-center gap-3">
                        <input id="first_name" class="w-[200px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="first_name" type="text" placeholder="first name">
                        <input id="middle_name" class="w-[200px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="middle_name" type="text" placeholder="middle name">
                        <input id="last_name" class="w-[200px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="last_name" type="text" placeholder="last name">
                        <span class="flex justify-center w-full">
                            <label for="gender" class="text-white w-[100px]">Gender</label>
                            <select id="gender" class="w-[200px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </span>
                    </div>
                </span>
                <span class="flex justify-start w-full">
                    <label for="job_status" class="text-white w-[150px]">Title</label>
                    <input id="job_status" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="job_status" type="text" placeholder="Freelancer">
                </span>
                <span class="flex justify-start w-full">
                    <span class="flex justify-between w-full">
                        <label for="address" class="text-white w-[150px]">Address</label>
                        <input id="address" class="w-full rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="address" type="text" placeholder="address">
                    </span>
                </span>
                <span class="flex justify-start w-full gap-3">
                    <span class="flex justify-start">
                        <label for="city" class="text-white w-[150px]">City</label>
                        <input id="city" class="w-[250px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="city" type="text" placeholder="city">
                    </span>
                    <span class="flex justify-start">
                        <label for="state" class="text-white w-[100px]">State</label>
                        <input id="state" class="w-[250px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="state" type="text" placeholder="state">
                    </span>
                    <span class="flex justify-start">
                        <label for="country" class="text-white w-[100px]">Country</label>
                        <input id="country" class="w-[250px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="country" type="text" placeholder="country">
                    </span>
                </span>
                <span class="flex justify-start w-full">
                    <label for="m_phone" class="text-white w-[150px]">Mobile phone</label>
                    <input id="m_phone" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="m_phone" type="text" placeholder="mobile phone">
                </span>
                <span class="flex justify-start w-full">
                    <label for="email" class="text-white w-[150px]">Email</label>
                    <input id="email" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="email" type="text" placeholder="email" value="{{ $user->email }}">
                </span>
                <span class="flex justify-start w-full">
                    <label for="work_now" class="text-white w-[150px]">Work now</label>
                    <input id="work_now" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="work_now" type="text" placeholder="work now">
                </span>
                <span class="flex justify-start w-full">
                    <label for="website" class="text-white w-[150px]">Website</label>
                    <input id="website" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="website" type="text" placeholder="website">
                </span>
                <span class="flex justify-start w-full">
                    <label for="hero" class="text-white w-[150px]">Hero</label>
                    <input id="hero" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="hero" type="text" placeholder="hero">
                </span>
            </div>
            <div class="col-span-12 flex justify-end mt-2 gap-5">
                <button type="submit" class="mt-2 bg-neutral-800 text-center text-white rounded w-28 h-6 p-0 m-0 hover:bg-neutral-700">Submit</button>
            </div>
        </form>
    </section>
@endsection
