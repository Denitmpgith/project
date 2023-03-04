@extends('template.main')
@section('container')
<section class="container grid grid-cols-12 gap-2 mt-2">
    @foreach($posts as $post)
    <div class="col-span-12 grid grid-cols-12 bg-slate-200 rounded-lg p-1 shadow lg:col-span-10">
        <div class="col-span-12 flex justify-start ">
            @if ( $post->level == "Stone" )
            <span class="text-stone-500 text-base">{{ $post->level }}&nbsp;</span>
            @elseif ( $post->level =="Bronze" )
            <span class="text-red-500 text-base">{{ $post->level }}&nbsp;</span>
            @elseif ( $post->level == "Silver" )
            <span class="text-yellow-500 text-base">{{ $post->level }}&nbsp;</span>
            @elseif ( $post->level == "Gold" )
            <span class="text-lime-500 text-base">{{ $post->level }}&nbsp;</span>
            @elseif ( $post->level == "Platinum" )
            <span class="text-cyan-500 text-base">{{ $post->level }}&nbsp;</span>
            @elseif ( $post->level == "Diamond" )
            <span class="text-purple-500 text-base">{{ $post->level }}&nbsp;</span>
            @endif
            <div class="flex justify-between w-full ">
                {{-- <p>{{ $post->user->user_detiles->first_name }}</p> --}}
                <a class="text-cyan-500" href="/dashboard/{{ $post->slug }}"><h4>{{ $post->title }}</h4></a>
                <p>Reward $ {{ $post->reward }}&nbsp;</p>
            </div>
        </div>
        <div class="col-span-12">
            <p>{{ Str::limit($post->description, 75) }}</p>
        </div>
    </div>
    @endforeach
</section>
@endsection
