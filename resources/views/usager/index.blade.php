@extends('template.main')
@section('container')
    <div class="rounded-b-lg w-full h-96 bg-neutral-900 grid grid-cols-12 gap-5">
        <div class="col-start-2 col-span-10 flex justify-start items-center w-full flex-wrap mt-32 ">
            <div class="h-52 w-52 bg-slate-900 " >
                <img src="" alt="">
            </div>
            <div class="p-0 m-0 flex justify-start flex-col ml-5">
                <p class="text-white mx-3 text-xl text-left font-semibold italic">{{ $user->user_detiles->first_name }}&nbsp;{{ $user->user_detiles->middle_name }}&nbsp;{{ $user->user_detiles->last_name }}</p>
                <hr>
                <p class="text-white mx-3 text-base text-left italic">{{ $user->user_detiles->job_status }}</p>
            </div>
        </div>
        <img src="" alt="">    
    </div>
    <div class="grid grid-cols-12 gap-5 mt-5 ">
        <div class="col-span-12 flex justify-start flex-col lg:col-span-4 bg-neutral-900 p-5 gap-5 rounded-t-lg">
            <div class="flex justify-center items-center flex-col gap-2 h-40 ">
                <div class="flex justify-center shadow w-full">
                    <p class="capitalize font-semibold text-white">My Profile</p>
                </div>
                <div class="flex justify-start items-start flex-col h-40 bg-neutral-800 w-full px-2">
                    @if ($user->user_detiles->job_status != null)
                    <div class="flex justify-between items-center flex-row w-full" >
                        <span class="text-white">{{ $user->user_detiles->job_status }}</span>
                        <p class="text-white">{{ $user->user_detiles->website }}</p>
                    </div>
                    @endif
                    @if ($user->user_detiles->country1 != null)
                        <div class="flex justify-between items-start flex-col" >
                            <p class="text-white">Freelancer from {{ $user->user_detiles->country1 }}</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="flex justify-center h-40 bg-neutral-800">
                <p class="text-white">Level user</p>
            </div>
        </div>
        <div class="col-span-12 flex justify-start flex-col lg:col-span-8 bg-neutral-900 p-5 gap-5 rounded-t-lg">
            @if( $appliesData->count() > 0)
            <div class="flex justify-center flex-col  p-2">
                <p class="text-white flex justify-center uppercase bg-neutral-800">My apply contest</p>
                <div class="flex justify-between flex-row gap-5 bg-neutral-800 mt-5 p-3" >
                        @foreach ($appliesData as $apply)
                        <div class="text-center">
                                @foreach ($apply->applyFile as $key => $file)
                                    @if ($key == 0)
                                        <img src="{{ asset('post-images/' . $file->filename) }}" alt="" width="200" height="200">
                                    @endif
                                @endforeach
                            <h3 class="text-white">{{ Str::limit($apply->title, 20) }}</h3>
                            {{-- <p class="text-white">{{ $apply->description }}</p> --}}
                        </div>
                        @endforeach
                </div>
            </div>
            @endif
            <div class="flex justify-center h-96 bg-neutral-800 p-2">
                <p class="text-white">My Fortofolio</p>
            </div>
        </div>
    </div>
@endsection 