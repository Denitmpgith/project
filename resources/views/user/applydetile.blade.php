@extends('template.main')
@section('container')
<section class="grid grid-cols-12">
    @include('user.welcome')
    <div class="col-span-12 grid grid-cols-12">
        <div class="col-span-12 grid grid-cols-12 md:col-span-12 h-fit lg:col-start-1 lg:col-span-12">
            <div class="col-span-12">
                <div class="flex justify-between">
                    <p class="text-cyan-500 text-lg"><a href="/fortopolio/{{ $apply->user->user_detiles->first_name }}">{{ ucfirst($apply->user->username) }}&nbsp;</a></p>
                    <p>{{ $apply->created_at->diffForHumans() }}</p>
                </div>
                <h2>{{ $apply->title }}</h2>
                <p>{{ $apply->description }}</p>
                <div class="grid grid-cols-12 gap-5 mt-2">
                    @foreach($apply->applyFile as $file)
                    <div class="container col-span-12 shadow rounded-lg p-3 md:col-span-4 lg:col-span-4 xl:col-span-3 bg-slate-200">
                        <div class="flex justify-center mb-2">
                            <img class="w-[175px] h-[175px]" src="" alt="">
                        </div>
                        <p>{{ $file->title }}</p>
                        <p>{{ $file->file }}</p>
                    </div>
                    @endforeach               
                </div>
            </div>
            <div class="col-span-12 flex justify-end mt-3 gap-3">
                <form class="flex justify-end gap-3" method="post" action="{{ route('apply.store', $apply->slug) }}">
                    @csrf
                    <button class="bg-green-500 rounded-lg p-1 w-32 text-center text-white hover:bg-green-600" type="submit" name="submit" value="Winner">Winner</button>
                    <button class="bg-green-500 rounded-lg p-1 w-32 text-center text-white hover:bg-green-600" type="submit" name="submit" value="Runner Up">Runner Up</button>
                    <button class="bg-red-500 rounded-lg p-1 w-32 text-center text-white hover:bg-red-600" type="submit" name="submit" value="Reject">Reject</button>
                    <button class="bg-blue-700 rounded-lg p-1 w-32 text-center text-white hover:bg-slate-600" type="submit" name="submit" value="norate">Cancel rate</button>
                </form>
                <a class="bg-slate-500 rounded-lg p-1 w-32 text-center text-white hover:bg-slate-600" href="/user/{{ $apply->post->slug }}">Back to</a>
            </div>            
        </div>
    </div>
</section>
@endsection
