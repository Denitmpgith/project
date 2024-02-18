<!DOCTYPE html>
@extends('template.main')

@section('container')
<section class="grid grid-cols-12 gap-1 p-2">
  @if(session('success'))
    <div class="alert alert-success col-span-12 text-blue-500 flex justify-center bg-neutral-700 rounded p-5">
        {{ session('success') }}
    </div>
  @endif
  <div class="col-span-12 flex justify-center items-center my-2 rounded flex-row px-5 bg-neutral-900 ">
    <h1 class="text-white">Want to make a contest ?&nbsp;</h1><a href="/user/create" class="flex justify-center items-center text-center bg-neutral-800 text-white rounded my-3 w-28 h-7 p-1 hover:bg-stone-700">create contest</a>
  </div>
  @foreach($posts as $post)
  @if($post->deadline-time() >= 1)
    <a class="col-span-12 grid grid-cols-12" href="/dashboard/{{ $post->slug }}">
      <div class="col-span-12 flex justify-start shadow p-2 bg-neutral-900 hover:bg-neutral-800 ">
          <div class="hidden lg:block w-[100px] h-[100px] shadow">
              <img src="" alt="">
          </div>
          <div class="w-full px-3">
            <div class="flex justify-between">
              <div>
                @if ($post->user_id == auth()->id())
                  <p class="text-green-500 text-center bg-neutral-800 px-2 py-1 w-fit">The contest is your own</p>
                @endif  
              </div>
            </div>  
            <div class="flex justify-between ">
              <div class="flex justify-start">
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
                    <h4 class="text-neutral-300" >{{ $post->title }}</h4>
                </div>
              </div>
              <div>
                @if($post->deadline-time() >= 1)
                <p id="countdown{{ $post->id }}" class=" px-2 bg-neutral-800"></p>
                @else
                <p class="text-red-500 bg-neutral-800">Contest end</p>
                @endif
              </div>
            </div>
            <div class="flex justify-between">
                <p class="text-neutral-300">{{ Str::limit($post->description, 75) }}</p>
                <p class="text-neutral-300">&nbsp;Reward : {{ $post->reward }}</p>
            </div>
        </div>
      </div>
    </a>
    @endif  
  @endforeach

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
                  countdownElement.innerHTML = "<span class='text-white'>contest end : </span>"  + "<span class='text-red-700'>" + seconds + "</span>" + " second";
                } else {
                  countdownElement.innerHTML = "<span class='text-white'>contest end : </span> "  + "<span class='text-red-500'>" + minutes + ":" + seconds + "</span>";
                }
              } else {
                countdownElement.innerHTML = "<span class='text-white'>contest end : </span> "  + "<span class='text-yellow-500'>" + hours + ":" + minutes + ":" + seconds + "</span>";
              }
            } else {
              countdownElement.innerHTML = "<span class='text-white'>contest end : </span> "  + "<span class='text-green-500'>" + days + " day " + hours + ":" + minutes + ":" + seconds + "</span>";
            }
          }
      }, 1000);
    }
  
    @foreach($posts as $post)
      @if($post->deadline-time() > 0)
        var countdownElement{{ $post->id }} = document.getElementById("countdown{{ $post->id }}");
        countdown({{ $post->deadline }}000, countdownElement{{ $post->id }});
      @endif
    @endforeach
  });
</script>