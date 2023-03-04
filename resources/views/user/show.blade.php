@extends('template.main')
@section('container')
<section class="grid grid-cols-12 ">
    @include('user.welcome')
    <div class="col-span-12 grid grid-cols-12">
    @include('user.acc')
        <div class="col-span-12 m-3 p-3 rounded-xl shadow md:col-span-12 lg:col-span-9">        
            <div class="grid grid-cols-12 rounded-xl mb-1 p-3">
                <div class="col-span-12 items-end mb-1 p-3 rounded-lg bg-slate-200">
                    <div class="grid grid-cols-12 rounded mb-1">
                        <div class="col-span-12 md:col-span-9 lg:col-span-9 xl:col-span-10 flex justify-between items-center">
                            <h5 class="text-2xl bold text-cyan-500"><span class="text-yellow-700 text-base">{{ $post->level }}</span>&nbsp;{{ $post->title }}</h5>
                        </div>
                        <div class="col-span-12 md:col-start-10 md:col-span-3 lg:col-start-10 lg:col-span-3 xl:col-start-11 xl:col-span-2 flex justify-between items-end">
                            <p>Reward : {{ $post->reward }}</p>
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
                    <small>create at : {{ $post->created_at->diffForHumans() }} | </small>
                    <small>Owner: {{ $post->user->user_detiles->first_name }}</small>
                    <p>{{ $post->description }}</p>
                </div>
                {{-- <p >&nbsp;from : {{ $post->user->count() }} user</p> --}}
                @if($post->applies->count() > 0)
                    <hr class="col-span-2 mt-3">
                    <div class="col-span-12 pb-2 flex justify-start text-cyan-500">
                        <p>{{ $post->applies->count() }} applies ,&nbsp;</p>
                        <p>from {{ $post->applies->groupBy('user_id')->count() }} user</p>
                    </div>
                    <hr class="col-span-12 mb-3">
                    <ul class="col-span-12 grid grid-cols-12 gap-2 mb-2">
                        @foreach ($post->applies as $apply)
                        <div class="col-span-12 bg-slate-200 p-2 rounded-lg lg:col-span-3">
                            <li class="text-cyan-500"><a href="/apply/{{ $apply->slug }}">{{ $apply->title }}</a></li>
                            {{-- @foreach($apply->applyFile as $applyFile)
                            <li>{{ $applyFile->file }}</li>
                            @endforeach --}}
                            @if($apply->applyFile->count() > 0)
                            <p>{{ $apply->applyFile->count() }} file uploaded</p>
                            @endif
                            <div class="flex justify-between">
                                <small class="ml-1">{{ $apply->user->user_detiles->first_name ?? 'not registered' }}</small>
                                <small class="">{{ $post->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @endforeach
                    </ul>
                @endif                   
                @if($post->comments->count() > 0)
                <hr class="col-span-2 mt-3">
                <h1 class="col-span-12 pb-1 text-cyan-500">Question and Answer :</h1>
                <hr class="col-span-12 mb-3">
                @foreach ($post->comments as $comment)
                <ul class="col-span-12">
                    <div class="col-span-12 grid grid-cols-12 bg-slate-200 p-2 mb-2 rounded lg:rounded-l-full ">
                        <div class="hidden col-start-1 col-span-1 p-1 lg:flex lg:justify-start">
                            <div class="shadow h-12 w-12 rounded-full bg-white">
                                <img src="" alt="">
                            </div>
                        </div>
                        <div class="col-span-12 mb-2 lg:col-start-2 lg:col-span-10">
                            <p>{{ $comment->user->user_detiles->first_name }}</p>
                            <div class="flex justify-between">
                                <p>{{ $comment->comment }}</p>
                                <p class="text-xs">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                    @foreach ($comment->replyComments as $reply)
                    <ul class="col-span-12 grid grid-cols-12 mb-1">
                        <div class="hidden col-start-1 col-span-1 lg:flex lg:justify-end p-2 ">
                            <div class="shadow h-10 w-10 rounded-full bg-slate-300">
                                <img src="" alt="">
                            </div>
                        </div>
                        <div class="lg:col-start-2 col-span-12 bg-slate-200 p-2 rounded-l-lg">
                            <p>{{ $reply->user->user_detiles->first_name }}&nbsp;</p>
                            <div class="flex justify-between">
                                <p>{{ $reply->replycomment }}</p>
                                <p class="text-xs">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </ul>
                    @endforeach
                </ul>
                @endforeach
                @endif  
            </div>
            <div class="col-span-12 flex justify-end align-bottom gap-3">
                {{-- @if($post->user, auth)
                @else
                @endif --}}
                {{-- <a class="bg-slate-500 rounded-lg p-1 w-32 h-8 text-center text-white hover:bg-slate-600" href="/user/entry" >Upload Entry</a> --}}
                <a class="bg-slate-500 rounded-lg p-1 w-32 h-8 text-center text-white hover:bg-slate-600" href="/user">Back</a>
            </div>
        </div>
    </div>
</section>
@endsection
