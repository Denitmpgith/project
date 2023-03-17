@extends('template.main')
@section('container')
<section class="grid grid-cols-12 ">
    @include('user.welcome')
    <div class="col-span-12 grid grid-cols-12">
        <div class="col-span-12 m-3 p-3 shadow ">
            <div class="grid grid-cols-12 mb-1 p-3 ">
                <div class="col-span-12 items-end mb-1 p-3 bg-blue-50">
                    <div class="grid grid-cols-12 rounded mb-1">
                        <div class="col-span-12 md:col-span-9 lg:col-span-9 xl:col-span-10 flex justify-between items-center">
                            <h5 class="text-2xl bold text-cyan-500"><span class="text-yellow-700 text-base">{{ $post->level }}</span>&nbsp;{{ $post->title }}</h5>
                        </div>
                        <div class="col-span-12 md:col-start-10 md:col-span-3 lg:col-start-10 lg:col-span-3 xl:col-start-11 xl:col-span-2 flex justify-between items-end">
                            <p>Reward $ {{ $post->reward }}</p>
                            @if ( $post->deadline - time() < 0 )
                            <small class="text-red-600">End Contest</small>
                            @elseif ( $post->deadline - time() < 3600 )
                            <small class="text-red-600">{{ floor(($post->deadline - time())/60) }} minute left</small>
                            @elseif ( $post->deadline - time() < 86400 )
                            <small class="text-yellow-600">{{ floor(($post->deadline - time())/3600) }} hour left</small>
                            @elseif ( $post->deadline - time() < 604800 )
                            <small class="text-green-600">{{ floor(($post->deadline - time())/86400) }} day left</small>
                            @elseif ( $post->deadline - time() < 2419200 )
                            <small class="text-green-600">{{ floor(($post->deadline - time())/604800) }} week left</small>
                            @endif
                        </div>
                    </div>
                    <small>create at : {{ $post->created_at->diffForHumans() }} | </small>
                    <small>Owner: {{ $post->user->user_detiles->first_name }}</small>
                    <p>{{ $post->description }}</p>
                    {{-- @foreach($post->postFiles as $files)
                        <p>{{ $files->name_file }}</p>
                    @endforeach --}}
                </div>
                {{-- <p >&nbsp;from : {{ $post->user->count() }} user</p> --}}
                @if($post->applies->count() > 0)
                    <hr class="col-span-2 mt-3">
                    <div class="col-span-12 pb-2 flex justify-start text-cyan-500">
                        <p>{{ $post->applies->count() }} applies ,&nbsp;</p>
                        <p>from {{ $post->applies->groupBy('user_id')->count() }} user</p>
                    </div>
                    <hr class="col-span-12 mb-3">
                    <ul class="col-span-12 grid grid-cols-12 gap-2 mb-2">
                        @foreach ($appliesData as $apply)
                        <a class="col-span-12 p-2 shadow md:col-span-6 lg:col-span-4 xl:col-span-3 hover:bg-blue-50" href="/user/apply/{{ $apply['slug'] }}">
                            <div class="">
                                @if ($apply['rateStatus'] == 'Winner')
                                    <div class="text-{{ $apply['color'] }} px-2 flex justify-between rounded-tr-lg p-2">
                                        <div class="-m-3 rounded">
                                            <img src="{{ asset('default/winner3.png') }}">
                                        </div>
                                        <div class="flex justify-end">
                                            <p>{{ $apply['rateStatus'] }}&nbsp;</p>
                                            <p>$ {{ $apply['reward'] }}</p>
                                        </div>
                                    </div>
                                @elseif ($apply['rateStatus'] == 'Runner Up')
                                <div class="text-{{ $apply['color'] }} px-2 flex justify-between p-2">
                                    <div class="-m-3 rounded">
                                        <img src="{{ asset('default/runnerup.png') }}">
                                    </div>
                                    <div class="flex justify-end">
                                        <p>{{ $apply['rateStatus'] }}&nbsp;</p>
                                        <p>$ {{ $apply['reward'] }}</p>
                                    </div>
                                </div>
                                @elseif ($apply['rateStatus'] == 'norate')
                                <div class="text-{{ $apply['color'] }} bg-white px-2 flex justify-between">
                                    <p>{{ $apply['rateStatus'] }}</p>
                                </div>
                                @elseif ($apply['rateStatus'] == 'Reject')
                                <div class="text-{{ $apply['color'] }} bg-white px-2 flex justify-between">
                                    <p>{{ $apply['rateStatus'] }}</p>
                                </div>
                                @endif
                                <p class="font-semibold">{{ $apply['title'] }}</p>
                                @if ($apply['applyFileCount'] > 0 )
                                    <p class="text-gray-600 text-xs">{{ $apply['applyFileCount'] }} Files has upload</p>
                                @endif
                                <p class="text-gray-600 text-xs">By {{ $apply['userFirstName'] }} {{ $apply['createdAt'] }}</p>
                            </div>
                        </a>
                        @endforeach
                    </ul>                  
                @endif                   
                @if ($post->comments->count() > 0)
                    <hr class="col-span-12 bg-slate-500">
                    <div class="col-span-12 pb-2 flex justify-start text-cyan-500">
                        <p>{{ $post->comments->count() }} Comment ,&nbsp;</p>
                        <p>from {{ $post->comments->groupBy('user_id')->count() }} user</p>
                    </div>
                    <hr class="col-span-12 mb-3">
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
            </div>
            <div class="col-span-12 flex justify-end align-bottom gap-3">
                {{-- @if($post->user, auth)
                @else
                @endif --}}
                {{-- <a class="bg-slate-500 rounded-lg p-1 w-32 h-8 text-center text-white hover:bg-slate-600" href="/user/entry" >Upload Entry</a> --}}
                <a class="bg-slate-500 rounded-lg p-1 w-32 h-8 text-center text-white hover:bg-slate-600" href="/user">Back</a>
            </div>
        </div>
    </div>
</section>
@endsection

<script>
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
</script>