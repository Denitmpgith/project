@extends('template.main')
@section('container')
<div class="mt-5 p-3 shadow">
    <div class="col-span-12 flex justify-start flex-col">
        <div class="flex justify-between items-end">
            <div>
                @if( $apply->rate_status == 'Winner')
                <div class="flex justify-start items-center">
                    <img src="{{ asset('default/winner3.png') }}">
                    <p class="uppercase text-xl font-bold px-3 text-red-500">{{ $apply->rate_status }}</p>
                </div>
                @elseif( $apply->rate_status == 'Runner Up')
                <div class="flex justify-start items-center">
                    <img src="{{ asset('default/runnerup.png') }}">
                    <p class="uppercase text-xl font-bold px-3 text-amber-500">{{ $apply->rate_status }}</p>
                </div>
                @endif
                <p class="text-cyan-500 text-lg font-bold">{{ $apply->title }}</p>
            </div>
            <span class="text-gray-500 text-xs">{{ $apply->created_at->diffForHumans() }}&nbsp;</span>
        </div>
        <p>{{ $apply->description }}</p>
    </div>
    <small class="col-span-12 flex justify-start items-end">
        <p>by :&nbsp;</p>
        <a href="/{{ $user->username }}" class=""><p class="text-cyan-500 capitalize">{{ $user->username }}&nbsp;</p></a>
    </small>
    <hr class="mt-3"> 
    @if (!empty($applyfiles))
    <div class="grid grid-cols-12 gap-1 flex-row mt-2">
        <div class="col-span-12">
            <p class="mb-2">ini saya lampirkan gambar hasil kerja saya, semoga membantu :</p>
        </div>
        @foreach($applyfiles as $file)
        <div class="col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3 shadow flex justify-center flex-col">
            <p class="text-center">{{ $file['title'] }}</p>
            <img class="w-full object-cover" src="{{ $file['image'] }}" alt="">
        </div>
        @endforeach
    </div>
    @endif
    <div class="flex justify-end align-bottom w-full gap-1 mt-3">
        <form class="flex justify-end gap-1" method="post" action="/user/{{ $apply->slug }}/store">
            @csrf
            @if( $totalWinners < 1 )
                <button class="bg-green-500 rounded p-1 w-32 text-center text-white hover:bg-green-600" type="submit" name="submit" value="Winner">Winner</button>
            @endif    
            @if( $totalRunnerUp < 2 )
                <button class="bg-green-500 rounded-lg p-1 w-32 text-center text-white hover:bg-green-600" type="submit" name="submit" value="Runner Up">Runner Up</button>
            @endif
            <button class="bg-red-500 rounded p-1 w-32 text-center text-white hover:bg-red-600" type="submit" name="submit" value="Reject">Reject</button>
            <button class="bg-blue-700 rounded p-1 w-32 text-center text-white hover:bg-slate-600" type="submit" name="submit" value="norate">Cancel rate</button>
        </form>
        <a class="bg-slate-500 rounded p-1 w-32 h-8 text-center text-white hover:bg-slate-600" href="/user/{{ $apply->post->slug }}">Back</a>
    </div>
</div>
@endsection
