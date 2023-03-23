@include('template.header')
@include('template.navbar')
<body class="grid grid-cols-12 bg-black">
    <section class="col-span-12 flex justify-around pt-16 items-center flex-col-reverse h-screen md:flex-row lg:flex-row">
        <div class="col-span-12 flex justify-center items-center p-2">
            <div class="w-[325px] h-[325px] md:h-[375px] md:w-[375px] lg:h-[500px] lg:w-[500px] xl:h-[650px] xl:w-[650px] flex justify-center items-center flex-col ">
                <div class="Flex justify-start flex-col">
                    <p class="text-white text-lg md:text-2xl lg:text-4xl">Selamat datang, <span class="uppercase font-bold text-cyan-500">Artifex</span></p>
                    <p class="text-white text-xs md:text-sm lg:text-base text-left">Kami sedang mencari orang yang mampu menciptakan karya luar biasa untuk klien kami.</p>
                    <p class="text-white text-xs md:text-sm lg:text-base text-left">Bersediakah gabung dengan tim kreatif kami dan jadilah bagian dari kami dalam menciptakan karya-karya yang luar biasa untuk klien kami.</p>
                </div>
            </div>
        </div>
        <div class="col-span-12 flex justify-center items-center p-2">
            <div class="w-[325px] h-[325px] md:h-[375px] md:w-[375px] lg:h-[500px] lg:w-[500px] xl:h-[650px] xl:w-[650px] flex justify-center items-center flex-col ">
                <img src="default/box2.png" alt="">
            </div>
        </div>
    </section>
    <div class="fixed -z-20 h-screen w-screen opacity-10 blur-sm flex justify-center items-center flex-col">
        <img class="bg-repeat" src="default/world_map.png" alt="">
    </div>
</body>
<footer class="col-span-12 grid grid-cols-12 bg-neutral-900">
    <div class="col-start-3 col-span-8">
        <div class="grid grid-cols-12 pt-3 gap-3 text-white">
            <div class="col-span-3 h-20 text-center">
                <p>Kategori</p>
            </div>
            <div class="col-span-3 h-20 text-center">
                <p>Aturan Kontes</p>
            </div>
            <div class="col-span-3 h-20 text-center">
                <p>Tentang Kita</p>
            </div>
            <div class="col-span-3 h-20 text-center">
                <p>Kontak</p>
            </div>
        </div>
    </div>
    <div class="col-span-12 py-3 flex justify-center">
        <small class="text-white text-center">&copy; 2023 company Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></small>
    </div>
</footer>
</html>