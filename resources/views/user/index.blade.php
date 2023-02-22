@extends('template.main')

@section('container')
<section class="grid grid-cols-12">
    <div class="col-span-12 flex justify-center items-center bg-slate-200 m-3 rounded-xl p-2">
        <span class="">Welcome... {{ $user_detiles->first_name }} {{ $user_detiles->middle_name }} {{ $user_detiles->last_name }}</span>
        <span>&nbsp;, apakabar hari ini ?</spa>
    </div>
    <div class="col-span-12 grid grid-cols-12 ">
        @include('template.acc')
        <div class="col-span-12 grid grid-cols-12 md:col-span-12 h-fit lg:col-start-4 lg:col-span-9">
            <div class="col-span-12 m-3 p-3 rounded-xl shadow md:col-span-12 h-fit">
                <h1 class="mb-5">Ikut Serta dalam Kontes</h1>
                @foreach ($applies as $apply)  
                <div class="bg-slate-200 p-2 rounded-lg mb-2">
                    <div class="rounded mb-1">
                        <p class="text-cyan-500"><a class="text-cyan-500" href="/user/{{ $apply->post->slug }}">{{ $apply->post->title }}</a></p>
                        <p class="">{{ $apply->title }}</p>
                        <p class="">{{ $apply->description }}</p>
                    </div>
                </div>          
                @endforeach
                <div class="flex justify-end">{{ $applies->links() }}</div>
            </div>        
            <div class="col-span-12 m-3 p-3 rounded-xl shadow md:col-span-12 h-fit">
                <h1 class="mb-5">Kontes yang di Buat</h1>
                @foreach ($posts as $post)  
                <div class="bg-slate-200 p-2 rounded-lg mb-2">
                    <div class="rounded mb-1 flex justify-between">
                        <p><a class="text-cyan-500" href="/user/{{ $post->slug }}">{{ $post->title }}</a></p>
                        <p>Reward : {{ $post->reward }}</p>
                    </div>
                    <div class="rounded mb-3">
                        {{ $post->description }}
                    </div>
                </div>          
                @endforeach
                <div class="flex justify-end">{{ $posts->links() }}</div>
            </div>
        </div>
    </div>
</section>
@endsection
