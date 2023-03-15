@extends('template.main')
@section('container')
<p>{{ $apply->id }}</p>
<p>{{ $apply->title }}</p>
<p>{{ $apply->description }}</p>
<div class="bg-blue-50">
    @if (!empty($applyfiles))
        @foreach($applyfiles as $file)
            <p>{{ $file['title'] }}</p>
            <div class="w-50 h-50">
                <img src="{{ $file['image'] }}" alt="{{ $file['title'] }}">
            </div>
        @endforeach
    @endif
</div>

<a class="bg-slate-500 rounded-lg p-1 w-32 h-8 text-center text-white hover:bg-slate-600" href="/user/{{ $apply->post->slug }}">Back</a>
@endsection
