@extends('template.main')

@section('container')
<section class="grid grid-cols-12 gap-2 mt-2 px-5">
    <div class="col-span-12 grid grid-cols-12 bg-slate-200 rounded-lg p-2 shadow">
        <span class="col-span-12 flex justify-between">
        @if ($post->user_id == auth()->id())
            <p class="text-white bg-amber-600 px-5 py-1 w-fit rounded-lg">( The contest is your own )</p>
        @endif  
            @if($post->deadline-time() >= 1)
            <p id="countdown{{ $post->id }}" class=" px-2 py-1 bg-white rounded"></p>
            @else
            <p class="text-red-500">Contest end</p>
            @endif
        </span>
        <div class="col-span-12 flex justify-start ">
            @if ( $post->level == "Stone" )
            <span class="text-stone-500 text-xl">{{ $post->level }}&nbsp;</span>
            @elseif ( $post->level =="Bronze" )
            <span class="text-red-500 text-xl">{{ $post->level }}&nbsp;</span>
            @elseif ( $post->level == "Silver" )
            <span class="text-yellow-500 text-xl">{{ $post->level }}&nbsp;</span>
            @elseif ( $post->level == "Gold" )
            <span class="text-lime-500 text-xl">{{ $post->level }}&nbsp;</span>
            @elseif ( $post->level == "Platinum" )
            <span class="text-cyan-500 text-xl">{{ $post->level }}&nbsp;</span>
            @elseif ( $post->level == "Diamond" )
            <span class="text-purple-500 text-xl">{{ $post->level }}&nbsp;</span>
            @endif
            <div class="flex justify-between w-full">
                {{-- <p>{{ $post->user->user_detiles->first_name }}</p> --}}
                <p class="text-cyan-500 text-xl font-bold my-1">{{ $post->title }}</p>
                <div class="flex justify-end">
                    <p>&nbsp; Reward $ {{ $post->reward }}&nbsp;</p>
                </div>
            </div>
        </div>
        <div class="col-span-12">
            <p>{{ $post->description }}</p>
        </div>
    </div>
    @if($post->applies->count() > 0)
        <hr class="col-span-2 mt-3">
        <div class="col-span-12 pb-2 flex justify-start text-xl font-bold text-cyan-600 ">
            <p>{{ $post->applies->count() }} applies ,&nbsp;</p>
            <p>from {{ $post->applies->groupBy('user_id')->count() }} user</p>
        </div>
        <hr class="col-span-12 mb-3">
        <ul class="col-span-12 grid grid-cols-12 gap-2 mb-2">
            <div class="col-span-12 grid grid-cols-12 gap-4">
                @foreach ($appliesData as $apply)
                <div class="col-span-12 bg-slate-200 p-2 rounded-lg md:col-span-6 lg:col-span-4 xl:col-span-3 h-fit">
                    @if ($apply['rateStatus'] == 'Winner')
                        <div class="text-{{ $apply['color'] }} bg-white px-2 flex justify-between rounded-t-lg">
                            <p>{{ $apply['rateStatus'] }}</p>
                            <p>$ {{ $apply['reward'] }}</p>
                        </div>
                    @elseif ($apply['rateStatus'] == 'Runner Up')
                        <div class="text-{{ $apply['color'] }} bg-white px-2 flex justify-between rounded-t-lg">
                            <p>{{ $apply['rateStatus'] }}</p>
                            <p>$ {{ $apply['reward'] }}</p>
                        </div>
                    @elseif ($apply['rateStatus'] == 'norate')
                    <div class="text-{{ $apply['color'] }} bg-white px-2 flex justify-between rounded-t-lg">
                        <p>{{ $apply['rateStatus'] }}</p>
                    </div>
                    @elseif ($apply['rateStatus'] == 'Reject')
                    <div class="text-{{ $apply['color'] }} bg-white px-2 flex justify-between rounded-t-lg">
                        <p>{{ $apply['rateStatus'] }}</p>
                    </div>
                    @endif
                        <p class="font-semibold">{{ $apply['title'] }}</p>
                        @if ($apply['applyFileCount'] > 0 )
                            <p class="text-gray-600 text-xs">{{ $apply['applyFileCount'] }} Files has upload</p>
                        @endif
                        <p class="text-gray-600 text-xs">By {{ $apply['userFirstName'] }} {{ $apply['createdAt'] }}</p>
                        <div class="flex justify-between items-center">
                            @if ($apply['rateStatus'] != 'Reject' && $apply['rateStatus'] != 'norate')
                                <span class="mt-2 px-2 py-1 text-sm font-semibold text-white rounded-lg bg-{{ $apply['color'] }}">{{ $apply['rateStatus'] }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>  
        </ul>                  
    @endif
    @if ($post->user_id !== auth()->id())
    <div class="col-span-12 flex justify-end mt-3 gap-3">
        <a class="bg-blue-500 rounded-lg p-1 w-32 text-center text-white hover:bg-blue-600" href="#">Join Contest</a>
    </div>
    @endif   
    @if ($post->comments->count() > 0)
    <hr class="col-span-2 mt-3">
    <h1 class="col-span-12 pb-1 text-xl font-bold text-cyan-600">Question and Answer :</h1>
    <hr class="col-span-12 mb-3">
    
    <ul class="col-span-12">
        @foreach ($post->comments as $comment)
        <li class="mb-4">
            <div class="grid grid-cols-12 bg-gray-100 p-4 rounded-lg">
                <div class="hidden lg:flex lg:justify-start col-span-1 p-1">
                    <div class="shadow h-12 w-12 rounded-full bg-gray-300">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="col-span-12 lg:col-start-2 lg:col-span-11">
                    <div class="flex items-center mb-2">
                        <span class="font-bold mr-2 text-gray-700">{{ $comment->user->user_detiles->first_name }}&nbsp;</span>
                        <span class="text-sm text-gray-800"><span class="font-extrabold">"</span>{{ $comment->comment }}<span class="font-extrabold">"</span></span>
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="text-gray-500 text-xs">{{ $post->created_at->diffForHumans() }}&nbsp;</span>
                        <a href="#" class="text-xs text-gray-500 mr-2 hover:text-blue-500">Reply</a>
                    </div>
                </div>
            </div>
    
            @foreach ($comment->replyComments as $reply)
            <div class="grid grid-cols-12 bg-gray-200 p-2 rounded-lg ml-8 my-1">
                <div class="hidden lg:flex lg:justify-start col-span-1 p-1">
                    <div class="shadow h-10 w-10 rounded-full bg-gray-300">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="col-span-12 lg:col-start-2 lg:col-span-11">
                    <div class="flex items-center mb-2">
                        <span class="font-bold mr-2 text-gray-700">{{ $reply->user->user_detiles->first_name }}&nbsp;</span>
                        <span class="text-sm text-gray-800"><span class="font-extrabold">"</span>{{ $reply->replycomment }}<span class="font-extrabold">"</span></span>
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="text-gray-500 text-xs">{{ $post->created_at->diffForHumans() }}&nbsp;</span>
                    </div>
                </div>
            </div>
            @endforeach
        </li>
        @endforeach
    </ul>
    @endif    

<div class="col-span-12 flex justify-end mt-4">
    <a class="bg-gray-600 rounded-lg py-1 px-4 w-32 text-center text-white hover:bg-gray-700" href="/dashboard">Back</a>
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
                    countdownElement.innerHTML = "contest end : " + "<span class='text-red-700'>" + seconds + "</span>" + " second";
                  } else {
                    countdownElement.innerHTML = "contest end : " + "<span class='text-red-500'>" + minutes + " : " + seconds + "</span>";
                  }
                } else {
                  countdownElement.innerHTML = "contest end : " + "<span class='text-yellow-500'>" + hours + " : " + minutes + " : " + seconds + "</span>";
                }
              } else {
                countdownElement.innerHTML = "contest end : " + "<span class='text-green-500'>" + days + " day " + hours + " : " + minutes + " : " + seconds + "</span>";
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