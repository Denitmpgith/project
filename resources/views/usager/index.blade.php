@extends('template.main')
@section('container')
    <div class="rounded-b-lg w-full h-96 bg-slate-500 grid grid-cols-12 gap-5">
        <div class="col-start-2 col-span-10 flex justify-start items-center w-full mt-32">
            <div class="h-52 w-48 bg-slate-900 rounded-full" >
                <img src="" alt="">
            </div>
            <p class="p-1 rounded ml-5 text-xl font-semibold italic">{{ $user->user_detiles->first_name }}&nbsp;{{ $user->user_detiles->middle_name }}&nbsp;{{ $user->user_detiles->last_name }}</p>
        </div>
        <img src="" alt="">    
    </div>
    <div class="grid grid-cols-12 gap-5 mt-5">
        <div class="col-span-12 flex justify-start flex-col lg:col-span-4 bg-slate-100 p-5 gap-5">
            <div class="flex justify-center h-40 bg-slate-200">
                <p>Rincian pengguna</p>
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
