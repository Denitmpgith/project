@extends('template.main')
@section('container')
<section class="container">
    @foreach($posts as $post)
        <a href="/dashboard/{{ $post->slug }}"><h4>{{ $post->title }}</h4></a>
        <p>{{ Str::limit($post->description, 75) }}</p>
        <p>reward $ : {{ $post->reward }}</p>
    @endforeach
</section>
@endsection
