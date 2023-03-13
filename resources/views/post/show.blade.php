@extends('template.main')

@section('container')
<section class="grid grid-cols-12 mt-2 px-5">
    <div class="col-span-12 grid grid-cols-12 bg-slate-200 rounded-lg p-2 shadow">
        <div class="col-span-12 flex justify-between">
            <div>
                @if ($post->user_id == auth()->id())
                    <p class="text-white text-center bg-amber-600 px-2 py-1 w-fit rounded">( The contest is your own )</p>
                @endif  
            </div>
            <div>
                @if($post->deadline-time() >= 1)
                <p id="countdown{{ $post->id }}" class=" px-2 bg-white rounded"></p>
                @else
                <p class="text-red-500">Contest end</p>
                @endif
            </div>
        </div>  
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
    @include('user.iapply')                     
    @endif
    @if ($post->user_id !== auth()->id())
        @if($post->deadline-time() >= 1)
            <div class="col-span-12 flex justify-end mt-3 gap-3">
                <a class="bg-blue-500 rounded-lg p-1 w-32 text-center text-white hover:bg-blue-600" href="#">Join Contest</a>
            </div>
        @endif
    @endif   
    <hr class="col-span-2 mt-2">
    <h1 class="col-span-12 pb-1 text-xl font-bold text-cyan-600">Question and Answer :</h1>
    <hr class="col-span-12">
    <form class="col-span-12" method="POST" action="/comments">
        @csrf
        <div class="flex justify-between items-end flex-col ">
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <textarea name="comment" placeholder="&nbsp;Your Comment here..." rows="3" class="bg-slate-100 h-20 w-full p-0 m-0 rounded border-gray-300 resize-none overflow-auto focus:border-blue-500 focus:outline-none" onkeypress="if(event.keyCode == 13) { this.form.submit(); return false; }" onkeydown="if(event.keyCode == 13) {this.value = this.value + '\n'; return false;}"></textarea>
            <button type="submit" class="mt-2 bg-blue-500 text-center text-white rounded w-28 h-6 p-0 m-0 hover:bg-blue-600">Submit</button>
        </div>                             
    </form>
    @if ($post->comments->count() > 0)
    <ul class="col-span-12 ">
        @foreach ($post->comments->sortByDesc('created_at') as $comment)
        <li class="mb-3">
            <div class="grid grid-cols-12 p-1 rounded-lg">
                <div class="hidden lg:flex lg:justify-start col-span-1 p-1">
                    <div class="shadow h-12 w-12 rounded-full bg-gray-300">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="col-span-12 lg:col-start-2 lg:col-span-11">
                    <div class="flex items-center mb-1">
                        <span class="font-bold mr-2 text-gray-700">{{ $comment->user->user_detiles->first_name }}&nbsp;</span>
                        <span class="text-sm text-gray-800"><span class="font-extrabold">"</span>{{ $comment->comment }}<span class="font-extrabold">"</span></span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-gray-500 text-xs">{{ $post->created_at->diffForHumans() }}&nbsp;</span>
                        <a id="reply-button-{{ $comment->id }}" href="#comment-form-{{ $comment->id }}" class="text-xs text-gray-500 mr-2 hover:text-blue-500" onclick="toggleForm({{ $comment->id }})">Reply</a>
                    </div>
                    <div id="reply-form-{{ $comment->id }}" style="display:none;">
                        <form method="POST" action="/comments/reply">
                            @csrf
                            <div class="flex justify-between items-end flex-col">
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <textarea name="replyComment" placeholder="&nbsp;Your reply here..." rows="3" class="bg-slate-100 h-20 w-full p-0 m-0 rounded border-gray-300 resize-none overflow-auto focus:border-blue-500 focus:outline-none" onkeypress="if(event.keyCode == 13) { this.form.submit(); return false; }" onkeydown="if(event.keyCode == 13) {this.value = this.value + '\n'; return false;}" autofocus></textarea>
                                <button type="submit" class="mt-2 bg-blue-500 text-white rounded w-28 h-6 p-0 m-0 hover:bg-blue-600">Submit</button>
                            </div>                             
                        </form>
                    </div>
                </div>                
            </div>
            @foreach ($comment->replyComments->sortBy('created_at') as $reply)
            <div class="grid grid-cols-12 p-1 rounded-lg ml-10 my-1">
                <div class="hidden lg:flex lg:justify-start col-span-1 p-1">
                    <div class="shadow h-10 w-10 rounded-full bg-gray-300">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="col-span-12 lg:col-start-2 lg:col-span-11">
                    <div class="flex items-center">
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
        <hr class="bg-slate-500">
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

    @foreach ($post->comments as $comment)
        function toggleForm(commentId) {
            // loop through all comment forms and hide them except for the one clicked
            @foreach ($post->comments as $c)
                if ({{$c->id}} !== commentId) {
                    const otherForm = document.getElementById('reply-form-{{$c->id}}');
                    const otherButton = document.getElementById('reply-button-{{$c->id}}');
                    if (otherForm.style.display !== "none") {
                        otherForm.style.display = "none";
                        otherButton.innerHTML = "Reply";
                    }
                }
            @endforeach

            // show or hide the clicked comment form
            const button = document.getElementById('reply-button-' + commentId);
            const form = document.getElementById('reply-form-' + commentId);
            if (form.style.display === "none") {
                form.style.display = "block";
                button.innerHTML = "Cancel";
                const textarea = form.querySelector('textarea');
                textarea.focus();
            } else {
                form.style.display = "none";
                button.innerHTML = "Reply";
            }
        }
    @endforeach

    const form = document.querySelector('form');
    form.addEventListener('submit', (event) => {
        event.preventDefault(); // menghentikan action default form

        const formData = new FormData(form); // membuat object FormData dengan data form

        fetch('/comments', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // lakukan apa yang ingin dilakukan setelah komentar berhasil dibuat
            // contoh: menambahkan komentar ke halaman tanpa memperbarui halaman
            const commentList = document.querySelector('.comment-list');
            const newComment = document.createElement('div');
            newComment.innerHTML = data.comment;
            commentList.appendChild(newComment);
        })
        .catch(error => console.error(error));
    });

</script>
