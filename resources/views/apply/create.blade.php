
@extends('template.main')

@section('container')
<section class="grid grid-cols-12 mt-2 px-5">
    <div class="col-span-12 grid grid-cols-12 bg-neutral-900 rounded-lg p-2 shadow">
        <div class="col-span-12 flex justify-between">
            <div>
                @if ($post->user_id == auth()->id())
                    <p class="text-white text-center bg-neutral-800 px-2 py-1 w-fit rounded">( The contest is your own )</p>
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
                {{-- <p>{{ $post->user->user_detiles->first_name }}</p> --}}
                <p class="text-cyan-500 text-xl font-bold my-1">{{ $post->title }}</p>
                <div class="flex justify-end">
                    <p class="text-white">&nbsp; Reward : {{ $post->reward }}&nbsp;</p>
                </div>
            </div>
        </div>
        <div class="col-span-12">
            <p class="text-white">{{ $post->description }}</p>
        </div>
    </div>
    <div class="col-span-12">
        <form method="POST" action="{{ route('apply.store', ['slug' => $post->slug]) }}" enctype="multipart/form-data">
            @csrf
            <div class="w-full mt-2">
                <div class="flex justify-start items-start flex-col mb-1">
                    <div class="flex justify-start items-start flex-row mb-1 w-full">
                        <label for="title" class="w-[150px] text-white">Title</label>
                        <input name="title" placeholder="25-letter suggestion." type="text" class="bg-black text-white border-solid border w-[750px] placeholder-neutral-700">
                    </div>
                    <div class="flex justify-start items-start flex-row mb-1 w-full">
                        <label for="description" class="w-[150px] text-white">Description</label>
                        <textarea name="description" placeholder="Description your apply" type="text" class="bg-black text-white border w-[750px] @error('description') is-invalid @enderror"></textarea>
                        @error('description')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex justify-center flex-col w-full bg-neutral-800 mt-2 p-3">
                        <div class="flex justify-center items-center flex-col w-full">
                                <label for="input_file" class="px-5 bg-white text-black">Upload File</label>
                                <input id="input_file" type="file" class="@error('filename') is-invalid @enderror text-white hidden" multiple name="filename[]">
                                @error('filename')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-span-12">
                            <ol class="text-white" id="file_list"></ol>
                        </div>
                        <script>
                            const input = document.getElementById('input_file');
                            const fileList = document.getElementById('file_list');
                            let lastFileNumber = 0;
                            const style = document.createElement('style');
                            style.innerHTML = '#file_list li { margin-bottom: 5px; display: flex; justify-content: space-between; }';
                            document.head.appendChild(style);
                            input.addEventListener('change', () => {
                              const files = input.files;
                              for (let i = 0; i < files.length; i++) {
                                const fileName = files[i].name;
                                let duplicateFound = false;
                                const listItems = fileList.querySelectorAll('li');
                                listItems.forEach((item) => {
                                  if (item.textContent.includes(fileName)) {
                                    duplicateFound = true;
                                  }
                                });
                                if (!duplicateFound) {
                                  const li = document.createElement('li');
                                  if (lastFileNumber > 0) {
                                    li.textContent = `${lastFileNumber + 1}) ${fileName}`;
                                  } else {
                                    li.textContent = `${i + 1}) ${fileName}`;
                                  }
                                  fileList.appendChild(li);
                                  lastFileNumber++;
                                }
                              }
                            });
                          </script>                          
                    </div>                     
                </div>                
                <div class="flex justify-end w-full">
                    <button type="submit" class="mt-2 bg-neutral-800 text-center text-white rounded w-28 h-6 p-0 m-0 hover:bg-neutral-700">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-span-12 flex justify-end mt-4">
        <a class="mt-2 bg-neutral-800 text-center text-white rounded w-28 h-6 p-0 m-0 hover:bg-neutral-700" href="/dashboard/{{ $post->slug }}">Back</a>
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