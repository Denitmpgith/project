@extends('template.main')
@section('container')
<p>{{ $apply->title }}</p>
<p>{{ $apply->description }}</p>
@if (!empty($applyfiles))
<div class="grid grid-cols-12 gap-1 flex-row">
        @foreach($applyfiles as $file)
        <div class="col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3 h-[100px] bg-slate-100">
                <div class="w-50 h-50">
                    <img src="{{ $file['image'] }}" alt="{{ $file['title'] }}">
                </div>
        </div>
    @endforeach
</div>
@endif

<a class="bg-slate-500 rounded-lg p-1 w-32 h-8 text-center text-white hover:bg-slate-600" href="/user/{{ $apply->post->slug }}">Back</a>
@endsection
