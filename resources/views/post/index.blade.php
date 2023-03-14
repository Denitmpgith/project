@extends('template.main')
@section('container')
<section class="grid grid-cols-12 gap-1 my-5 p-2">
  @foreach($posts as $post)
    @if($post->deadline-time() >= 1)
    <a class="col-span-12 grid grid-cols-12" href="/dashboard/{{ $post->slug }}">
      <div class="col-span-12 flex justify-start shadow p-2 hover:bg-slate-100 ">
          <div class="hidden lg:block w-[100px] h-[100px] shadow">
              <img src="" alt="">
          </div>
          <div class="w-full px-3">
            <div class="flex justify-between">
              <div>
                @if ($post->user_id == auth()->id())
                  <p class="text-dark text-center bg-slate-100 px-2 py-1 w-fit rounded">The contest is your own</p>
                @endif  
              </div>
            </div>  
            <div class="flex justify-between">
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
                    <h4 class="text-cyan-500" >{{ $post->title }}</h4>
                </div>
              </div>
              <div>
                @if($post->deadline-time() >= 1)
                <p id="countdown{{ $post->id }}" class=" px-2 bg-slate-100"></p>
                @else
                <p class="text-red-500 bg-slate-100">Contest end</p>
                @endif
              </div>
            </div>
              <div class="flex justify-between">
                  <p>{{ Str::limit($post->description, 75) }}</p>
                  <p>&nbsp;Reward $ {{ $post->reward }}</p>
              </div>
          </div>
      </div>
    </a>
    @endif  
  @endforeach
      <div class="col-span-12 flex justify-between items-end flex-col">
        <h1>Ingin Membuat kontest seperti di atas ?</h1>
          {{-- <textarea name="reply" placeholder="&nbsp;&nbsp;made your own contest here..." rows="3" class="rounded-lg bg-slate-100 h-16 w-full p-0 m-0 border-gray-300 resize-none overflow-auto focus:border-blue-500 focus:outline-none" onkeypress="if(event.keyCode == 13) { this.form.submit(); return false; }" onkeydown="if(event.keyCode == 13) {this.value = this.value + '\n'; return false;}"></textarea> --}}
        <a href="/user/create" class="flex justify-center items-center text-center bg-blue-500 text-white rounded my-3 w-28 h-7 p-1 hover:bg-blue-600">create contest</a>
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
                  countdownElement.innerHTML = "count down end : "  + "<span class='text-red-700'>" + seconds + "</span>" + " second";
                } else {
                  countdownElement.innerHTML = "count down end : "  + "<span class='text-red-500'>" + minutes + ":" + seconds + "</span>";
                }
              } else {
                countdownElement.innerHTML = "count down end : "  + "<span class='text-yellow-500'>" + hours + ":" + minutes + ":" + seconds + "</span>";
              }
            } else {
              countdownElement.innerHTML = "count down end : "  + "<span class='text-green-500'>" + days + " day " + hours + ":" + minutes + ":" + seconds + "</span>";
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