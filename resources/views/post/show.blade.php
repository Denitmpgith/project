@extends('template.main')

@section('container')
<section class="container grid grid-cols-12 gap-2 mt-2">
    <div class="col-span-12 grid grid-cols-12 bg-slate-200 rounded-lg p-1 shadow">
        <div class="col-span-12 flex justify-start">
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
                <p class="text-cyan-500">{{ $post->title }}</p>
                <p>Reward $ {{ $post->reward }}&nbsp;</p>
            </div>
        </div>
        <div class="col-span-12">
            <p>{{ $post->description }}</p>
        </div>
    </div>
    @if($post->applies->count() > 0)
    <h5 class="col-span-12 ">Applies job</h5>
    <hr class="col-span-12 ">
    <div class="col-span-12 grid grid-cols-12 gap-2">
        @foreach ($post->applies as $apply)
            <div class="col-span-12 lg:col-span-3 bg-slate-200 rounded p-2">
                <p>{{ $apply->user->user_detiles->first_name ?? 'not registered' }}</p>
                <div>{{ $apply->title }}</div>
                @foreach($apply->applyFile as $applyFile)
                    <div>{{ $applyFile->file }}</div>
                @endforeach
            </div>
        @endforeach
    </div>
    <div class="col-span-12 flex justify-end mt-3 gap-3">
        <a class="bg-blue-500 rounded-lg p-1 w-32 text-center text-white hover:bg-blue-600" href="#">Join Contest</a>
    </div>
    @endif
    @if($post->comments->count() > 0)
    <div class="col-span-12">
        <h5>Question and Answer:</h5>
        <hr>
        <ul>
            @foreach ($post->comments as $comment)
                <li>{{ $comment->user->user_detiles->first_name }}</li>
                <li>{{ $comment->comment }}</li>
                <ul>
                    @foreach ($comment->replyComments as $reply)
                        <li>{{ $reply->user->user_detiles->first_name }}</li>
                        <li>{{ $reply->replycomment }}</li>
                    @endforeach
                    <hr>
                </ul>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-span-12 flex justify-end mt-3 gap-3">
        <a class="bg-slate-500 rounded-lg p-1 w-32 text-center text-white hover:bg-slate-600" href="/dashboard">Back</a>
    </div>
</section>
@endsection
