@include('template.header')
@include('template.navbar')
<body class="grid grid-cols-12 gap-4 pt-16">
<section class="col-span-12 lg:col-start-3 lg:col-span-8">
@yield('container')
</section>
</body>
@include('template.footer')
