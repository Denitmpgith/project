<nav class="absolute top-0 left-0 right-0 w-full shadow h-16">
    <div class="grid grid-cols-12">
        <div class="col-span-1"></div>
        <div class="col-span-3 flex justify-start items-center h-16">
            <a class="text-2xl italic text-cyan-500 align-content-center" href="/">website</a>
        </div>
        <div class="col-span-7 ">
            <div class="flex justify-start items-center h-16">
                <button id="hamburger" name="hamburger" type="button" class="block absolute right-12 lg:hidden">
                    <span class="hamburger-line transsition duration-300 ease-in out origin-top-left "></span>
                    <span class="hamburger-line transsition duration-300 ease-in out"></span>
                    <span class="hamburger-line transsition duration-300 ease-in out origin-bottom-left"></span>
                </button>
                <navbar id="nav-menu" class="hidden absolute py-5 bg-white shadow rounded-xl max-w-[200px] w-full right-0 top-full lg:flex lg:justify-end lg:static lg:bg-transparent lg:max-w-full lg:shadow-none lg:rounded-none">
                    <ul class="block lg:flex">
                        <li class="text-base text-dark py-1 mx-3 flex hover:text-cyan-500 {{ Request::is('/') ? 'active' : '' }}"><a class="" href="/">Home</a></li>
                        <hr class="my-2">
                        <li><a class="text-base text-dark py-1 mx-3 flex hover:text-cyan-500 {{ Request::is('signin') ? 'active' : '' }}" href="/dashboard">Lihat Kontes</a></li>
                        @auth
                        <li {{ auth()->User()->username }}></li>
                        <li><a class="text-base text-dark py-1 mx-3 flex hover:text-cyan-500 {{ Request::is('signin') ? 'active' : '' }}" href="/fortopolio">Fortopolio</a></li>
                        <li><a class="text-base text-dark py-1 mx-3 flex hover:text-cyan-500 {{ Request::is('signin') ? 'active' : '' }}" href="/user">My Profile</a></li>
                        <hr class="mt-4">
                            <form action="/logout" method="post">
                            @csrf
                            <button class="text-base text-dark py-1 mx-3 flex hover:text-cyan-500 " type ="submit">logout</button>
                            </form>
                        </ul>
                        @else
                        <li ><a class="text-base text-dark py-1 mx-3 flex hover:text-cyan-500  {{ Request::is('signin') ? 'active' : '' }}" href="/signin">Login</a></li>    
                        @endauth
                    </ul>
                </navbar>
            </div>
        </div>
        <div class="col-span-1"></div>
    </div>
</nav>
<script>
    //navbar fixed
window.onscroll = function() {
    const header = document.querySelector('nav');
    const fixedNav = header.offsetTop;

    if(window.pageYOffset > fixedNav) {
        header.classList.add('navbar-fixed');
    } else {
        header.classList.remove('navbar-fixed');
    }
}
    //hamburger
const hamburger = document.querySelector("#hamburger");
const navMenu = document.querySelector("#nav-menu");

hamburger.addEventListener("click", function () {
    hamburger.classList.toggle("hamburger-active");
    navMenu.classList.toggle("hidden");
});
</script>