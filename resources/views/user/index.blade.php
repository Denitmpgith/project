@extends('template.main')
@section('container')
<section class="grid grid-cols-12">
    @include('user.welcome')
    <div class="col-span-12 grid grid-cols-12 mt-3 gap-3">
        <div class="col-span-12 grid grid-cols-12 md:col-span-12 h-fit lg:col-start-1 lg:col-span-9 shadow">
            @if( $applies->count() > 0)
            <div class="col-span-12 m-2 p-3 md:col-span-12 h-fit">
                <div class="mb-2 flex justify-between items-center shadow p-2">
                    <h1 class="text-white">Ikut Serta dalam Kontes</h1>
                </div> 
                @foreach ($applies as $apply)  
                <div class="p-2 shadow mb-1 bg-neutral-900">
                    <div class="rounded mb-1">
                        <div class="grid grid-cols-12 rounded mb-1 ">
                            <div class="col-span-12 flex justify-between items-end">
                                <p class="capitalize text-cyan-500">{{ $apply->post->title }}</p>
                                <div class="flex justify-between items-end">
                                    <p class="text-white">Reward : {{ $apply->post->reward }}&nbsp;</p>
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
                        <p class="text-white">{{ $apply->title }}</p>
                        <p class="text-white">{{ $apply->description }}</p>
                    </div>
                </div>          
                @endforeach
                <div class="flex justify-end">{{ $applies->links() }}</div>
            </div>
            @endif       
            <div class="col-span-12 m-3 p-3 md:col-span-12 h-fit ">
                @if(empty($user_detiles->first_name))
                @else
                    <div class="col-span-12 flex justify-center items-center my-2 rounded flex-row px-5 bg-neutral-900 ">
                        <h1 class="text-white">Want to make a new contest ?&nbsp;</h1><a href="/user/create" class="flex justify-center items-center text-center bg-neutral-800 text-white rounded my-3 w-28 h-7 p-1 hover:bg-stone-700">create contest</a>
                    </div>
                @endif                 
                @foreach ($posts as $post)
                <a href="/user/{{ $post->slug }}">
                    <div class="shadow p-2 mb-2 bg-neutral-900 hover:bg-neutral-800">
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
                                <p class="text-white">Reward : {{ $post->reward }}&nbsp;</p>
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
                        <div class="rounded mb-3 text-white">
                            {{ $post->description }}
                        </div>
                    </div>          
                </a>
                @endforeach
                <div  class="col-span-12 flex justify-center w-full ">
                    <div class="flex justify-between">{{ $posts->links() }}</div>
                </div>
            </div>
        </div>
        @include('user.acc')
    </div>
</section>
@endsection