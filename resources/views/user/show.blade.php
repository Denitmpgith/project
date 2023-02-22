@extends('template.main')
@section('container')
<section class="grid grid-cols-12 ">
    <div class="col-span-12 flex justify-center items-center bg-slate-200 m-3 rounded-xl p-2">
        <span class="">Welcome... {{ $user_detiles->first_name }} {{ $user_detiles->middle_name }} {{ $user_detiles->last_name }}</span>
        <span>&nbsp;, hari ini mencari perkerjaan seperti apa ?</spa>
    </div>
    <div class="col-span-12 grid grid-cols-12">
        @include('template.acc')
        <div class="col-span-12 m-3 p-3 rounded-xl shadow md:col-span-12 lg:col-span-9">        
            <div class="grid grid-cols-12 rounded-xl mb-1 p-3">
                <div class="col-span-12 items-end mb-1 p-3 rounded-lg bg-slate-200"">
                    <div class="flex justify-between items-end pb-3">
                        <h5 class="text-2xl bold text-cyan-500">{{ $post->title }}</h5>
                        <spa>Reward $ : {{ $post->reward }}</spa>
                    </div>
                    <small>create at : {{ $post->created_at->diffForHumans() }} | </small>
                    <small>Owner: {{ $post->user->user_detiles->first_name }}</small>
                    <p>{{ $post->description }}</p>
                </div>
                <hr class="col-start-10 col-span-3 mt-3">
                <div class="col-span-12 pb-2 flex justify-end text-cyan-500">
                    <p >Total apply Contest : {{ $post->applies->count()}} applies,</p>
                    <p >&nbsp;from : {{ $post->user->count()}} user</p>
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
