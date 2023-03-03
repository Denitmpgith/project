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
                    <div class="flex justify-end mt-2">
                        <a href="/user/entry" class="bg-slate-500 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded-lg">Membuat Entry Baru</a>
                    </div>
                </div>
                <hr class="col-span-2 mt-3">
                <div class="col-span-12 pb-2 flex justify-start text-cyan-500">
                    <p>Apply Contest :</p>
                    {{-- <p >&nbsp;from : {{ $post->user->count() }} user</p>
                    <p >Total apply Contest : {{ $post->applies->count() }} applies ,</p>
                    <p >&nbsp;from : {{ $post->user->count() }} user</p> --}}
                </div>
                <hr class="col-span-12 mb-3">
                <ul class="col-span-12 grid grid-cols-12 gap-2 mb-2">
                    @foreach ($post->applies as $apply)
                    <div class="col-span-3 bg-slate-200 p-2 rounded-lg">
                        <li class="text-cyan-500"><a href="/apply/{{ $apply->slug }}">{{ $apply->title }}</a></li>
                        @foreach($apply->applyFile as $applyFile)
                        <li>{{ $applyFile->file }}</li>
                        @endforeach
                        <div class="flex justify-between">
                            <small class="ml-1">{{ $apply->user->user_detiles->first_name ?? 'not registered' }}</small>
                            <small class="">{{ $post->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    @endforeach
                    
                </ul>
                <hr class="col-span-2 mt-3">
                <h1 class="col-span-12 pb-1 text-cyan-500">Question and Answer :</h1>
                <hr class="col-span-12 mb-3">
                @foreach ($post->comments as $comment)
                <ul class="col-span-12">
                    <div class="grid grid-cols-12 bg-slate-200 py-1 px-1 rounded-lg my-1">
                        <li class="col-span-1">{{ $comment->user->user_detiles->first_name }}</li>
                        <li class="col-span-9">: {{ $comment->comment }}</li>
                        <small class="col-start-11 col-span-2 text-right">{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                    @foreach ($comment->replyComments as $reply)
                    <ul class="grid grid-cols-12 py-1 px-1">
                        <li class="col-span-1">{{ $reply->user->user_detiles->first_name }}</li>
                        <li class="col-span-9">: {{ $reply->replycomment }}</li>
                        <small class="col-start-11 col-span-2 text-right">{{ $post->created_at->diffForHumans() }}</small>
                    </ul>
                    @endforeach
                </ul>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
