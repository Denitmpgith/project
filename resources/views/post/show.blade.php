@extends('template.main')

@section('container')
<section class="container">
    <h5>{{ $post->title }}</h5>
    <p>{{ $post->description }}</p>
    <p>reward $ : {{ $post->reward }}</p>
    <p>Owner: {{ $post->user->user_detiles->first_name }}</p>
    <h5>Applies job:</h5>
    <hr>
    <ul>
        @foreach ($post->applies as $apply)
            <p>{{ $apply->user->user_detiles->first_name ?? 'not registered' }}</p>
            <li>{{ $apply->title }}</li>
            @foreach($apply->applyFile as $applyFile)
                <li>{{ $applyFile->file }}</li>
            @endforeach
            <hr>
        @endforeach
    </ul>
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
</section>
@endsection
