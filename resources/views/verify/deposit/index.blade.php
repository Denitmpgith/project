@extends('template.main')
@section('container')
<section>
    <h1 class="text-white">Helloo <span class="capitalize">{{ $auth->username }}</span></h1>
    <h1 class="text-white">Ada 2 cara untuk mengisi nominal di website kita</h1>
    <h1 class="text-white">1. Dengan cara transfer melalui rekening resmi dari bank yang kita kita gunakan</h1>
    <h1 class="text-white">2. Menggunakan kartu Visa, auto debet. untuk yang ini, memerlukan surat persetujuan penarikan dana dari rekening yang di daftarkan</h1>
</section>
@endsection
