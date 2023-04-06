@extends('template.main')
@section('container')
    <section>
        @if(session('failed'))
        <div class="alert alert-success col-span-12 text-white flex justify-center bg-neutral-700 rounded p-5">
            {{ session('failed') }}
        </div>
        @endif
        <div class="flex justify-start flex-col mt-3 w-full gap-3 bg-neutral-900 p-3 rounded shadow">
        <h1 class="text-white text-center capitalize">Registration Form</h1>
        </div>
        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="flex justify-start flex-col mt-3 w-full gap-3 bg-neutral-900 p-5 rounded shadow">
                <span class="flex justify-start w-full">
                    <label for="first_name" class="text-white w-[150px]">First name</label>
                    <div class="flex justify-center gap-3">
                        <input id="first_name" class="w-[200px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="first_name" type="text" placeholder="first name" autofocus>
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
                <div class="flex justify-start flex-col w-full gap-3 bg-neutral-900 py-3 px-3 border border-white rounded shadow">
                    <h1 class="text-white w-full">Home :</h1>
                    <span class="flex justify-start w-full">
                        <span class="flex justify-start w-full">
                            <label for="address1" class="text-white w-[150px]">Address</label>
                            <input id="address1" class="w-[1000px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="address1" type="text" placeholder="address">
                        </span>
                    </span>
                    <span class="flex justify-start w-full gap-3">
                        <span class="flex justify-start">
                            <label for="city1" class="text-white w-[150px]">City</label>
                            <input id="city1" class="w-[250px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="city1" type="text" placeholder="city">
                        </span>
                        <span class="flex justify-start">
                            <label for="state1" class="text-white w-[100px]">State</label>
                            <input id="state1" class="w-[250px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="state1" type="text" placeholder="state">
                        </span>
                        <span class="flex justify-start">
                            <label for="country1" class="text-white w-[100px]">Country</label>
                            <input id="country1" class="w-[250px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="country1" type="text" placeholder="country">
                        </span>
                    </span>
                    <span class="flex justify-start">
                        <label for="phone1" class="text-white w-[150px]">phone1</label>
                        <input id="phone1" class="w-[250px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="phone1" type="text" placeholder="phone">
                    </span>
                </div>
                <div class="flex justify-start flex-col w-full gap-3 bg-neutral-900 py-3 px-3 border border-white rounded shadow">
                    <h1 class="text-white w-full">Office :</h1>
                    <span class="flex justify-start w-full">
                        <span class="flex justify-start w-full">
                            <label for="address2" class="text-white w-[150px]">Address</label>
                            <input id="address2" class="w-[1000px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="address2" type="text" placeholder="address">
                        </span>
                    </span>
                    <span class="flex justify-start w-full gap-3">
                        <span class="flex justify-start">
                            <label for="city2" class="text-white w-[150px]">City</label>
                            <input id="city2" class="w-[250px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="city2" type="text" placeholder="city">
                        </span>
                        <span class="flex justify-start">
                            <label for="state2" class="text-white w-[100px]">State</label>
                            <input id="state2" class="w-[250px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="state2" type="text" placeholder="state">
                        </span>
                        <span class="flex justify-start">
                            <label for="country2" class="text-white w-[100px]">Country</label>
                            <input id="country2" class="w-[250px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="country2" type="text" placeholder="country">
                        </span>
                    </span>
                    <span class="flex justify-start">
                        <label for="phone2" class="text-white w-[150px]">phone2</label>
                        <input id="phone2" class="w-[250px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="phone2" type="text" placeholder="phone">
                    </span>
                </div>
                <div class="flex justify-start w-full gap-3">
                    <label class="text-white w-[150px]">Mobile phone</label>
                    <input id="m_phone1" class="w-[250px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="m_phone1" type="text" placeholder="mobile phone">
                    <input id="m_phone2" class="w-[250px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="m_phone2" type="text" placeholder="mobile phone">
                </div>
                <div class="flex justify-start w-full gap-3">
                    <label for="email" class="text-white w-[150px]">Email</label>
                    <input id="email1" class="w-[250px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="email1" type="text" placeholder="email" value="{{ $user->email }}">
                    <input id="email2" class="w-[250px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="email2" type="text" placeholder="email">
                </div>
                <div  class="flex justify-start w-full">
                    <label for="work_now" class="text-white w-[150px]">Work now</label>
                    <input id="work_now" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="work_now" type="text" placeholder="work now">
                </div>
                <div n class="flex justify-start w-full">
                    <label for="website" class="text-white w-[150px]">Website</label>
                    <input id="website" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="website" type="text" placeholder="website">
                </div>
                <div class="flex justify-start w-full">
                    <label for="hero" class="text-white w-[150px]">Hero</label>
                    <input id="hero" class="w-[500px] rounded bg-neutral-800 text-white px-2 placeholder-neutral-700" name="hero" type="text" placeholder="hero">
                </div>
            </div>
            <div class="col-span-12 flex justify-end mt-2 gap-5">
                <button type="submit" class="mt-2 bg-neutral-800 text-center text-white rounded w-28 h-6 p-0 m-0 hover:bg-neutral-700">Submit</button>
            </div>
        </form>
    </section>
@endsection
