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
        <hr class="col-span-2 mt-3">
        <div class="col-span-12 pb-2 flex justify-start text-cyan-500">
            <p>{{ $post->applies->count() }} applies ,&nbsp;</p>
            <p>from {{ $post->applies->groupBy('user_id')->count() }} user</p>
        </div>
        <hr class="col-span-12 mb-3">
        <ul class="col-span-12 grid grid-cols-12 gap-2 mb-2">
            @foreach ($post->applies->sortBy(function ($apply) {
                return $apply->rate_status == 'Winner' ? 3 : ($apply->rate_status == 'Runner Up' ? 2 : ($apply->rate_status == 'norate' ? 1 : 0));
            })->reverse() as $apply)                        
                @if($apply->rate_status == 'Winner')
                    <div class="col-span-12 bg-slate-200 p-2 rounded-lg md:col-span-6 lg:col-span-4 xl:col-span-3 h-fit">
                        <div class="text-green-600 bg-white px-2 flex justify-between rounded-t-lg">
                            <p >{{ $apply->rate_status }}</p>
                            <p>$ {{ number_format(floor($post->reward/100*70/$post->applies->where('rate_status', 'Winner')->count() * 100) / 100, 0, '.', '') }}</p>
                        </div>
                        <div class="h-[200px] mt-2 flex justify-center w-full">
                            <img class="h-[175px] w-[175px] shadow mt-2 bg-slate-500" src="" alt="">
                        </div>
                        <div class="text-black">{{ Str::limit($apply->title, 30) }}</div>
                        <div class="">
                            <div class="flex justify-between">
                                <small class="ml-1">{{ $apply->user->user_detiles->first_name ?? 'not registered' }}</small>
                                <small class="">{{ $post->created_at->diffForHumans() }}</small>
                            </div>
                            @if($apply->applyFile->count() > 0)
                                <p class="text-xs">{{ $apply->applyFile->count() }} file uploaded</p>
                            @endif
                        </div>
                    </div>
                @elseif($apply->rate_status == 'Runner Up')
                    <div class="col-span-12 bg-slate-200 p-2 rounded-lg md:col-span-6 lg:col-span-4 xl:col-span-3 h-fit">
                        <div class="text-yellow-600 bg-white px-2 flex justify-between rounded-t-lg">
                            <p >{{ $apply->rate_status }}</p>
                            <p>$ {{ number_format(floor($post->reward/100*20/$post->applies->where('rate_status', 'Runner Up')->count() * 100) / 100, 0, '.', '') }}</p>
                        </div>
                        <div class="h-[200px] mt-2 flex justify-center w-full">
                            <img class="h-[175px] w-[175px] shadow mt-2 bg-slate-500" src="" alt="">
                        </div>
                        <div class="text-black">{{ Str::limit($apply->title, 30) }}</div>
                        <div class="">
                            <div class="flex justify-between">
                                <small class="ml-1">{{ $apply->user->user_detiles->first_name ?? 'not registered' }}</small>
                                <small class="">{{ $post->created_at->diffForHumans() }}</small>
                            </div>
                            @if($apply->applyFile->count() > 0)
                                <p class="text-xs">{{ $apply->applyFile->count() }} file uploaded</p>
                            @endif
                        </div>
                    </div>
                @elseif($apply->rate_status == 'norate')
                    <div class="col-span-12 bg-slate-200 p-2 rounded-lg md:col-span-6 lg:col-span-4 xl:col-span-3 h-fit">
                        <div class="text-black bg-white px-2 flex justify-between rounded-t-lg">
                            <p >{{ $apply->rate_status }}</p>
                            <p>$ {{ number_format(floor($post->reward/100*10/$post->applies->where('rate_status', 'norate')->count() * 100) / 100, 0, '.', '') }}</p>
                        </div>
                        <div class="h-[200px] mt-2 flex justify-center w-full">
                            <img class="h-[175px] w-[175px] shadow mt-2 bg-slate-500" src="" alt="">
                        </div>
                        <div class="text-black">{{ Str::limit($apply->title, 30) }}</div>
                        <div class="">
                            <div class="flex justify-between">
                                <small class="ml-1">{{ $apply->user->user_detiles->first_name ?? 'not registered' }}</small>
                                <small class="">{{ $post->created_at->diffForHumans() }}</small>
                            </div>
                            @if($apply->applyFile->count() > 0)
                                <p class="text-xs">{{ $apply->applyFile->count() }} file uploaded</p>
                            @endif
                        </div>
                    </div>
                @elseif($apply->rate_status == 'Reject')
                    <div class="col-span-12 bg-slate-200 p-2 rounded-lg md:col-span-6 lg:col-span-4 xl:col-span-3 h-fit">
                        <div class="text-red-600 bg-white px-2 flex justify-center rounded-t-lg">
                            <p >{{ $apply->rate_status }}</p>
                        </div>
                        <div class="h-[200px] mt-2 flex justify-center w-full">
                            <img class="h-[175px] w-[175px] shadow mt-2 bg-slate-500" src="" alt="">
                        </div>
                        <div class="text-black">{{ Str::limit($apply->title, 30) }}</div>
                        <div class="">
                            <div class="flex justify-between">
                                <small class="ml-1">{{ $apply->user->user_detiles->first_name ?? 'not registered' }}</small>
                                <small class="">{{ $post->created_at->diffForHumans() }}</small>
                            </div>
                            @if($apply->applyFile->count() > 0)
                                <p class="text-xs">{{ $apply->applyFile->count() }} file uploaded</p>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </ul>                  
    @endif   
    <div class="col-span-12 flex justify-end mt-3 gap-3">
        <a class="bg-blue-500 rounded-lg p-1 w-32 text-center text-white hover:bg-blue-600" href="#">Join Contest</a>
    </div>
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
                        <div class="col-span-12 mb-2 lg:col-start-2 lg:col-span-11">
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