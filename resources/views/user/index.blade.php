@extends('template.main')
@section('container')
<section class="grid grid-cols-12">
    @include('user.welcome')
    <div class="col-span-12 grid grid-cols-12 ">
        <div class="col-span-12 grid grid-cols-12 md:col-span-12 h-fit lg:col-start-1 lg:col-span-9">
            <div class="col-span-12 m-3 p-3 md:col-span-12 h-fit">
                <h1 class="mb-5">Ikut Serta dalam Kontes</h1>
                @foreach ($applies as $apply)  
                <div class="p-2 shadow mb-2">
                    <div class="rounded mb-1">
                        <div class="grid grid-cols-12 rounded mb-1 ">
                            <div class="col-span-12 flex justify-between items-end">
                                <p class="text-cyan-500"><a class="text-cyan-500" href="/user/{{ $apply->post->slug }}">{{ $apply->post->title }}</a></p>
                                <div class="flex justify-between items-end">
                                    <p>Reward : {{ $apply->post->reward }}&nbsp;</p>
                                    @if ( $apply->post->deadline - time() < 0 )
                                    <small class="text-red-600">End Contest</small>
                                    @elseif ( $apply->post->deadline - time() < 3600 )
                                    <small class="text-red-600">{{ floor(($apply->post->deadline - time())/60) }} minute left</small>
                                    @elseif ( $apply->post->deadline - time() < 86400 )
                                    <small class="text-yellow-600">{{ floor(($apply->post->deadline - time())/3600) }} hour left</small>
                                    @elseif ( $apply->post->deadline - time() < 604800 )
                                    <small class="text-green-600">{{ floor(($apply->post->deadline - time())/86400) }} day left</small>
                                    @elseif ( $apply->post->deadline - time() < 2419200 )
                                    <small class="text-green-600">{{ floor(($apply->post->deadline - time())/604800) }} week left</small>
                                    @endif 
                                </div>
                            </div>
                        </div>
                        <p class="">{{ $apply->title }}</p>
                        <p class="">{{ $apply->description }}</p>
                    </div>
                </div>          
                @endforeach
                <div class="flex justify-end">{{ $applies->links() }}</div>
            </div>        
            <div class="col-span-12 m-3 p-3 md:col-span-12 h-fit">
                <div class="mb-2 flex justify-between items-center rounded-lg ">
                    <h1 class="px-2 py-2">Kontes yang di Buat</h1>
                    <a href="/user/create" class="bg-slate-500 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded-lg">Tambah Baru</a>
                </div>                 
                @foreach ($posts as $post)
                <div class="shadow p-2 mb-2 hover:bg-blue-50">
                    <a href="/user/{{ $post->slug }}">
                        <div class="flex justify-between rounded mb-1 ">
                            <div class="flex justify-between items-end">
                                <p class="text-cyan-500" >
                                @if ( $post->level == "Stone" )
                                <span class="text-stone-500 text-base">{{ $post->level }}</span>
                                @elseif ( $post->level =="Bronze" )
                                <span class="text-red-500 text-base">{{ $post->level }}</span>
                                @elseif ( $post->level == "Silver" )
                                <span class="text-yellow-500 text-base">{{ $post->level }}</span>
                                @elseif ( $post->level == "Gold" )
                                <span class="text-lime-500 text-base">{{ $post->level }}</span>
                                @elseif ( $post->level == "Platinum" )
                                <span class="text-cyan-500 text-base">{{ $post->level }}</span>
                                @elseif ( $post->level == "Diamond" )
                                <span class="text-purple-500 text-base">{{ $post->level }}</span>
                                @endif
                                &nbsp;{{ $post->title }}</p>
                            </div>
                            <div class="flex justify-between items-end">
                                <p>Reward : {{ $post->reward }}&nbsp;</p>
                                @if ( $post->deadline - time() < 0 )
                                <small class="text-red-600">End Contest</small>
                                @elseif ( $post->deadline - time() < 3600 )
                                <small class="text-red-600">{{ floor(($post->deadline - time())/60) }} minute left</small>
                                @elseif ( $post->deadline - time() < 86400 )
                                <small class="text-yellow-600">{{ floor(($post->deadline - time())/3600) }} hour left</small>
                                @elseif ( $post->deadline - time() < 604800 )
                                <small class="text-green-600">{{ floor(($post->deadline - time())/86400) }} day left</small>
                                @elseif ( $post->deadline - time() < 2419200 )
                                <small class="text-green-600">{{ floor(($post->deadline - time())/604800) }} week left</small>
                                @endif 
                            </div>
                        </div>
                        <div class="rounded mb-3">
                            {{ $post->description }}
                        </div>
                    </a>
                </div>          
                @endforeach
                <div class="flex justify-end">{{ $posts->links() }}</div>
            </div>
        </div>
        @include('user.acc')
    </div>
</section>
@endsection