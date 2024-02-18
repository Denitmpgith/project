@include('template.header')
@include('template.navbar')
<body class="grid grid-cols-12 bg-black">
    <section class="col-span-12 flex justify-around pt-16 items-center flex-col-reverse h-screen md:flex-row lg:flex-row">
        <div class="col-span-12 flex justify-center items-center p-2">
            <div class="w-[325px] h-[325px] md:h-[375px] md:w-[375px] lg:h-[500px] lg:w-[500px] xl:h-[650px] xl:w-[650px] flex justify-center items-center flex-col ">
                <div class="Flex justify-start flex-col">
                    <p class="text-white text-lg md:text-2xl lg:text-4xl">Hallo <span class="capitalize font-bold text-cyan-500">Artifex</span>&nbsp;. . . </p>
                    {{-- <p class="text-white text-xs md:text-sm lg:text-base text-left">We are currently looking for individuals who are capable of creating exceptional works for our clients. Would you like to join our creative team and be part of a team that creates extraordinary works for our clients?"</p> --}}
                    <p class="text-white text-xs md:text-sm lg:text-base text-left">"Kami sedang mencari seseorang yang bisa membuat karya beda dari yang lain.</p>
                    <p class="text-white text-xs md:text-sm lg:text-base text-left">Apakah Anda tertarik bergabung dengan kami untuk menjual hasil karya anda bersama kami ?"</p>
                    {{-- </br>
                    <p class="text-white text-xs md:text-sm lg:text-base text-left">Kami adalah perusahaan jasa Artifex yang terdiri dari tim yang berdedikasi, terampil, dan penuh semangat dalam menghasilkan karya-karya kreatif yang memukau. Dari konsep hingga hasil akhir, kami menyediakan layanan kreatif dan teknis terbaik di industri ini, dan memiliki tim ahli yang berkomitmen untuk menghasilkan karya-karya yang memukau dengan pengalaman dan keahlian yang telah teruji. Kami mengedepankan kualitas dan inovasi dalam setiap proyek yang kami tangani, dan memastikan bahwa setiap karyawan kami dibayar dengan adil dan dihargai atas keahlian mereka. Gabunglah dengan kami dan temukan cara baru untuk menciptakan karya-karya kreatif yang luar biasa bersama dengan para ahli di bidangnya.</p> --}}
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
    {{-- <div class="col-span-12 Flex justify-center flex-col">
        <p class="text-white">Total Registrations :&nbsp;<span class="capitalize font-bold text-cyan-500">{{ $totalUsers }}</span>&nbsp;Freelancer </p>
    </div> --}}
    <div class="col-start-3 col-span-8">
        <div class="grid grid-cols-12 pt-3 gap-3 text-white">
            <div class="col-span-3 h-20 text-center">
                <p>Category</p>
            </div>
            <div class="col-span-3 h-20 text-center">
                <p>Contest Rules</p>
            </div>
            <div class="col-span-3 h-20 text-center">
                <p>About Us</p>
            </div>
            <div class="col-span-3 h-20 text-center">
                <p>Contact</p>
            </div>
        </div>
    </div>
    <div class="col-span-12 py-3 flex justify-center">
        <small class="text-white text-center">&copy; 2023 company Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></small>
    </div>
</footer>
</html>