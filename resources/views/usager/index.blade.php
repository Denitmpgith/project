@extends('template.main')
@section('container')
    <div class="rounded-b-lg w-full h-96 bg-slate-500 grid grid-cols-12 gap-5">
        <div class="col-start-2 col-span-10 flex justify-start items-center w-full mt-32 ">
            <div class="h-52 w-52 bg-slate-900 " >
                <img src="" alt="">
            </div>
            <div class="p-0 m-0 flex justify-start flex-col ml-5">
                <p class="rounded mx-3 text-xl text-left font-semibold italic">{{ $user->user_detiles->first_name }}&nbsp;{{ $user->user_detiles->middle_name }}&nbsp;{{ $user->user_detiles->last_name }}</p>
                <hr>
                <p class="rounded mx-3 text-base text-left italic">{{ $user->user_detiles->job_status }}</p>
            </div>
        </div>
        <img src="" alt="">    
    </div>
    <div class="grid grid-cols-12 gap-5 mt-5">
        <div class="col-span-12 flex justify-start flex-col lg:col-span-4 bg-slate-100 p-5 gap-5">
            <div class="flex justify-center items-center flex-col gap-2 h-40 ">
                <div class="flex justify-center shadow w-full">
                    <p class="capitalize font-semibold">My Profile</p>
                </div>
                <div class="flex justify-start items-start flex-col h-40 bg-slate-200 w-full">
                    <div class="flex justify-between items-center flex-row w-full" >
                        <span class="">{{ $user->user_detiles->job_status }}</span>
                        <p>{{ $user->user_detiles->website }}</p>
                    </div>
                    <div class="flex justify-between items-start flex-col" >
                        <p>Freelancer from {{ $user->user_detiles->country }}</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center h-40 bg-slate-200">
                <p>Rincian pengguna</p>
            </div>
        </div>
        <div class="col-span-12 flex justify-start flex-col lg:col-span-8 bg-slate-100 p-5 gap-5">
            <div class="flex justify-center h-48 bg-slate-200">
                <p>Fortofolio</p>
            </div>
            <div class="flex justify-center h-96 bg-slate-200">
                <p>Fortofolio</p>
            </div>
        </div>
    </div>
@endsection
