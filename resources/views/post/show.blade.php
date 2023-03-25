@extends('template.main')

@section('container')
<section class="grid grid-cols-12 mt-2 px-5">
    <div class="col-span-12 grid grid-cols-12 p-2 shadow bg-neutral-900">
        <div class="col-span-12 flex justify-between">
            <div>
                @if ($post->user_id == auth()->id())
                    <p class="text-white text-center bg-neutral-800 px-2 py-1 w-fit rounded">The contest is your own</p>
                @endif  
            </div>
            <div>
                @if($post->deadline-time() >= 1)
                <p id="countdown{{ $post->id }}" class=" px-2 bg-neutral-800 rounded"></p>
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
                <p class="text-cyan-500 text-xl font-bold my-1">{{ $post->title }}</p>
                <div class="flex justify-end">
                    <p class="text-white">&nbsp; Reward : {{ $post->reward }}&nbsp;</p>
                </div>
            </div>
        </div>
        <div class="col-span-12">
            <p class="text-white">{{ $post->description }}</p>
        </div>
        @foreach($post->postFile as $file)
            <div class="col-span-12">
                @if(pathinfo($file->filename, PATHINFO_EXTENSION) === 'jpg' || pathinfo($file->filename, PATHINFO_EXTENSION) === 'png')
                    <img style="width: 150px; height: 150px;" src="{{ asset('post-images/' . $file->filename) }}" alt="Gambar {{ $file->id }}">
                @else
                    <a class="text-white" href="{{ asset('post-noimages/' . $file->filename) }}" download>{{ $file->filename }}</a>
                @endif
            </div>
        @endforeach      
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
                <div class="col-span-12 p-2 shadow md:col-span-6 lg:col-span-4 xl:col-span-3 bg-neutral-900">
                    @if ($apply['rateStatus'] == 'Winner')
                        <div class="text-{{ $apply['color'] }} px-2 flex justify-between rounded-tr-lg p-2">
                            <div class="-m-3 rounded">
                                <img src="{{ asset('default/winner3.png') }}">
                            </div>
                            <div class="flex justify-end">
                                <p class="text-white">{{ $apply['rateStatus'] }}&nbsp;</p>
                                <p class="text-white">$ {{ $apply['reward'] }}</p>
                            </div>
                        </div>
                    @elseif ($apply['rateStatus'] == 'Runner Up')
                    <div class="text-{{ $apply['color'] }} px-2 flex justify-between p-2">
                        <div class="-m-3 rounded">
                            <img src="{{ asset('default/runnerup.png') }}">
                        </div>
                        <div class="flex justify-end">
                            <p class="text-white">{{ $apply['rateStatus'] }}&nbsp;</p>
                            <p class="text-white">$ {{ $apply['reward'] }}</p>
                        </div>
                    </div>
                    @elseif ($apply['rateStatus'] == 'norate')
                    <div class="text-{{ $apply['color'] }} bg-neutral-800 px-2 flex justify-between">
                        <p class="text-white">{{ $apply['rateStatus'] }}</p>
                    </div>
                    @elseif ($apply['rateStatus'] == 'Reject')
                    <div class="text-{{ $apply['color'] }} bg-neutral-800 px-2 flex justify-between">
                        <p class="text-white">{{ $apply['rateStatus'] }}</p>
                    </div>
                    @endif
                            <p class="font-semibold text-cyan-600">{{ $apply['title'] }}</p>
                        @if ($apply['applyFileCount'] > 0 )
                            <p class="text-white text-xs">{{ $apply['applyFileCount'] }} Files has upload</p>
                        @endif
                        <p class="text-white text-xs">By {{ $apply['userFirstName'] }} {{ $apply['createdAt'] }}</p>
                </div>
            @endforeach
        </div>  
    </ul>                    
    @endif
    @if ($post->user_id !== auth()->id())
        @if($post->deadline-time() >= 1)
            <div class="col-span-12 flex justify-end mt-3 gap-3">
                <a class="mt-2 bg-neutral-800 text-center text-white rounded w-28 h-6 p-0 m-0 hover:bg-neutral-700" href="/apply/{{ $post->slug }}">Join Contest</a>
                {{-- <a class="mt-2 bg-neutral-800 text-center text-white rounded w-28 h-6 p-0 m-0 hover:bg-neutral-700" href="/apply/{{ $post->slug }}">Bad Reward</a>
                <a class="mt-2 bg-neutral-800 text-center text-white rounded w-28 h-6 p-0 m-0 hover:bg-neutral-700" href="/apply/{{ $post->slug }}">Not my Skill</a> --}}
            </div>
        @endif
    @endif   
    <hr class="col-span-2 mt-2">
    <h1 class="col-span-12 pb-1 text-xl font-bold text-cyan-600">Question and Answer :</h1>
    <hr class="col-span-12 mb-2">
    <form class="col-span-12" method="POST" action="/comments">
        @csrf
        <div class="flex justify-between items-end flex-col ">
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <textarea name="comment" placeholder="&nbsp;Your Comment here..." rows="3" class="bg-neutral-900 text-white h-20 w-full p-0 m-0 rounded border-gray-300 resize-none overflow-auto focus:border-blue-500 focus:outline-none" onkeypress="if(event.keyCode == 13) { this.form.submit(); return false; }" onkeydown="if(event.keyCode == 13) {this.value = this.value + '\n'; return false;}"></textarea>
            <button type="submit" class="mt-2 bg-neutral-800 text-center text-white rounded w-28 h-6 p-0 m-0 hover:bg-neutral-700">Submit</button>
        </div>                             
    </form>
    @if ($post->comments->count() > 0)
    <ul class="col-span-12 ">
        @foreach ($post->comments->sortByDesc('created_at') as $comment)
        <li class="mb-3">
            <div class="grid grid-cols-12 p-1">
                <div class="hidden lg:flex lg:justify-start col-span-1 p-1">
                    <div class="shadow h-12 w-12 rounded-full bg-neutral-900">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="col-span-12 lg:col-start-2 lg:col-span-11">
                    <div class="flex items-center mb-1">
                        @if($comment->user_id === $post->user_id)
                            <span class="font-bold mr-2 text-neutral-100">CH&nbsp;</span>
                        @else
                            <span class="font-bold mr-2 text-neutral-100">{{ $comment->user->user_detiles->first_name }}&nbsp;</span>
                        @endif
                        <span class="text-sm text-white"><span class="font-extrabold text-white">"</span>{{ $comment->comment }}<span class="font-extrabold">"</span></span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-neutral-200 text-xs">{{ $post->created_at->diffForHumans() }}&nbsp;</span>
                        <a id="reply-button-{{ $comment->id }}" href="#comment-form-{{ $comment->id }}" class="text-xs text-white mr-2 hover:text-blue-500" onclick="toggleForm({{ $comment->id }})">Reply</a>
                    </div>
                    <div id="reply-form-{{ $comment->id }}" style="display:none;">
                        <form method="POST" action="/comments/reply">
                            @csrf
                            <div class="flex justify-between items-end flex-col">
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <textarea name="replyComment" placeholder="&nbsp;Your reply here..." rows="3" class="bg-neutral-900 text-white h-20 w-full p-0 m-0 rounded border-gray-300 resize-none overflow-auto focus:border-blue-500 focus:outline-none" onkeypress="if(event.keyCode == 13) { this.form.submit(); return false; }" onkeydown="if(event.keyCode == 13) {this.value = this.value + '\n'; return false;}" autofocus></textarea>
                                <button type="submit" class="mt-2 bg-neutral-800 text-center text-white rounded w-28 h-6 p-0 m-0 hover:bg-neutral-700">Submit</button>
                            </div>                             
                        </form>
                    </div>
                </div>                
            </div>
            @foreach ($comment->replyComments->sortBy('created_at') as $reply)
            <div class="grid grid-cols-12 p-1 ml-10 my-1">
                <div class="hidden lg:flex lg:justify-start col-span-1 p-1">
                    <div class="shadow h-10 w-10 rounded-full bg-neutral-900">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="col-span-12 lg:col-start-2 lg:col-span-11">
                    <div class="flex items-center">
                        @if($reply->user_id === $post->user_id)
                            <span class="font-bold mr-2 text-neutral-100">CH&nbsp;</span>
                        @else
                            <span class="font-bold mr-2 text-neutral-100">{{ $reply->user->user_detiles->first_name }}&nbsp;</span>
                        @endif
                        <span class="text-sm text-white"><span class="font-extrabold">"</span>{{ $reply->replycomment }}<span class="font-extrabold">"</span></span>
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="text-white text-xs">{{ $post->created_at->diffForHumans() }}&nbsp;</span>
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
        <a class="mt-2 bg-neutral-800 text-center text-white rounded w-28 h-6 p-0 m-0 hover:bg-neutral-700" href="/dashboard">Back</a>
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
                    countdownElement.innerHTML = "<span class='text-white'>contest end : </span>" + "<span class='text-red-700'>" + seconds + "</span>" + " second";
                  } else {
                    countdownElement.innerHTML = "<span class='text-white'>contest end : </span>" + "<span class='text-red-500'>" + minutes + " : " + seconds + "</span>";
                  }
                } else {
                  countdownElement.innerHTML = "<span class='text-white'>contest end : </span>" + "<span class='text-yellow-500'>" + hours + " : " + minutes + " : " + seconds + "</span>";
                }
              } else {
                countdownElement.innerHTML = "<span class='text-white'>contest end : </span>" + "<span class='text-green-500'>" + days + " day " + hours + " : " + minutes + " : " + seconds + "</span>";
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