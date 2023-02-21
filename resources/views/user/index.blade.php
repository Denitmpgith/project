@extends('template.main')

@section('container')
<section class="container">
<h1 style="display: flex; justify-content: center; align-items: center; color: rgb(14, 85, 143);">ini halaman User</h1>
<div class="">
    <img src="{{ $picture }}" width="200"></p>
</div>
<div class="m-0 p-0">
    <p class="m-0 p-0">first name : {{ $user_detiles->first_name }}</p>
    <p class="m-0 p-0">middle name : {{ $user_detiles->middle_name }}</p>
    <p class="m-0 p-0">last name : {{ $user_detiles->last_name }}</p>
    <p class="m-0 p-0">address : {{ $user_detiles->address }}</p>
    <p class="m-0 p-0">city : {{ $user_detiles->city }}</p>
    <p class="m-0 p-0">country : {{ $user_detiles->country }}</p>
    <p class="m-0 p-0">Mobile Phone : {{ $user_detiles->m_phone }}</p>
    <p class="m-0 p-0">email : {{ $user_detiles->email }}</p>
</div>
</section>
@endsection
