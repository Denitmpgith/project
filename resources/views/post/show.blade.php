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
            <div class="flex justify-between w-full">
                {{-- <p>{{ $post->user->user_detiles->first_name }}</p> --}}
                <p class="text-cyan-500">{{ $post->title }}</p>
                <div class="flex justify-end">
                    @if($post->deadline-time() >= 1)
                        <p id="countdown{{ $post->id }}"></p>
                    @else
                        <p class="text-red-500">Contest end</p>
                    @endif
                    <p>&nbsp; Reward $ {{ $post->reward }}&nbsp;</p>
                </div>
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
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
      function countdown(deadline, countdownElement) {
        var countdownInterval = setInterval(function() {
          var currentTime = new Date().getTime();
          var timeLeft = deadline - currentTime;
          var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
          var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000); 
          if (timeLeft <= 0) {
              clearInterval(countdownInterval);
              countdownElement.innerHTML = "Contest End";
            } else {
              if (days <= 0) {
                if (hours <= 0) {
                  if (minutes <= 0) {
                    countdownElement.innerHTML = "count down end : " + "<span class='text-red-700'>" + seconds + "</span>" + " second";
                  } else {
                    countdownElement.innerHTML = "count down end : " + "<span class='text-red-500'>" + minutes + ":" + seconds + "</span>";
                  }
                } else {
                  countdownElement.innerHTML = "count down end : " + "<span class='text-yellow-500'>" + hours + ":" + minutes + ":" + seconds + "</span>";
                }
              } else {
                countdownElement.innerHTML = "count down end : " + "<span class='text-green-500'>" + days + " day " + hours + ":" + minutes + ":" + seconds + "</span>";
              }
            }
        }, 1000);
      }
    
    @if($post->deadline-time() > 0)
        var countdownElement{{ $post->id }} = document.getElementById("countdown{{ $post->id }}");
        countdown({{ $post->deadline }}000, countdownElement{{ $post->id }});
    @endif
    });
  </script>