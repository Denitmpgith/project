@include('template.header')
@include('template.navbar')
<body class="grid grid-cols-12 gap-4 pt-16">
<div class="col-span-1"></div>
<section class="col-span-10">
@yield('container')
</section>
<div class="col-span-1"></div>
</body>
@include('template.footer')
