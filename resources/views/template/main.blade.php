@include('template.header')
@include('template.navbar')
<body class="grid grid-cols-12 gap-4 pt-16">
<section class="col-start-2 col-span-10">
@yield('container')
</section>
</body>
@include('template.footer')
