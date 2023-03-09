@extends('template.main')
@section('container')
<section class="grid grid-cols-12 gap-3 my-5">
    @foreach($posts as $post)
    <div class="col-span-12 flex justify-start bg-slate-200 rounded-lg shadow p-3">
        <div class="hidden lg:block w-[100px] h-[100px] shadow rounded bg-blue-500">
            <img src="" alt="">
        </div>
        <div class="w-full px-3">
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
                    <a class="text-cyan-500" href="/dashboard/{{ $post->slug }}"><h4>{{ $post->title }}</h4></a>
                    @if($post->deadline-time() < 0)
                    <p>waktu Kontes Berakhir</p>
                    @else
                        @if(date('d', $post->deadline-time()) < 1)
                            <p id="countdown" class="text-red-700">{{ date('H:i:s', $post->deadline-time()) }}</p>
                        @else
                            <p id="countdown" class="text-red-400">{{ date('d', $post->deadline-time()) }} day {{ date('H:i:s', $post->deadline-time()) }} left</p>
                        @endif
                    @endif
    
                </div>
            </div>
            <div class="flex justify-between">
                <p>{{ Str::limit($post->description, 75) }}</p>
                <p>&nbsp;Reward $ {{ $post->reward }}</p>
            </div>
        </div>
    </div>
    @endforeach
</section>
@endsection

{{-- <script>
    function countdown(deadline, countdownElement) {
      var countdownInterval = setInterval(function() {
        var currentTime = new Date().getTime();
        var timeLeft = deadline - currentTime;
        var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
        countdownElement.innerHTML = days + " day " + hours + " hour " + minutes + " minute " + seconds + " second ";
        if (timeLeft < 0) {
          clearInterval(countdownInterval);
          countdownElement.innerHTML = "waktu Kontes Berakhir";
        }
      }, 1000);
    }
    
    @foreach($posts as $post)
      @if($post->deadline-time() > 0)
        var countdownElement{{ $post->id }} = document.getElementById("countdown{{ $post->id }}");
        countdown({{ $post->deadline }}000, countdownElement{{ $post->id }});
      @endif
    @endforeach
</script> --}}
    

{{-- <script>
    function countdown() {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("countdown").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "countdown.php", true);
      xmlhttp.send();
    }
    
    setInterval(countdown, 1000);
</script> --}}