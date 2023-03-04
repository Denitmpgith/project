@extends('template.main')
@section('container')
<section class="grid grid-cols-12">
    @include('user.welcome')
    <div class="col-span-12 grid grid-cols-12">
    @include('user.acc')
        <div class="col-span-12 grid grid-cols-12 md:col-span-12 h-fit lg:col-start-4 lg:col-span-9">
            <div class="col-span-12">
                <div class="flex justify-between">
                    <p>{{ ucfirst($apply->user->username) }}&nbsp;</p>
                    <p>{{ $apply->created_at->diffForHumans() }}</p>
                </div>
                <h2>{{ $apply->title }}</h2>
                <p>{{ $apply->description }}</p>
                <div class="grid grid-cols-12 gap-2">
                    @foreach($apply->applyFile as $file)
                    <div class="container col-span-3 shadow rounded-lg p-3">
                        <img class="w-52 h-52" src="" alt="">
                        <p>{{ $file->title }}</p>
                        <p>{{ $file->file }}</p>
                    </div>
                    @endforeach               
                </div>
            </div>
            <div class="col-span-12 flex justify-end mt-3 gap-3">
                <a class="bg-green-500 rounded-lg p-1 w-32 text-center text-white hover:bg-green-600" href="#">Winner</a>
                <a class="bg-red-500 rounded-lg p-1 w-32 text-center text-white hover:bg-red-600" href="#">Reject</a>
                <a class="bg-slate-500 rounded-lg p-1 w-32 text-center text-white hover:bg-slate-600" href="/user/{{ $apply->post->slug }}">Back to</a>
            </div>
        </div>
    </div>
</section>
@endsection
