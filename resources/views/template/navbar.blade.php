<nav class="absolute top-0 left-0 right-0 w-full shadow shadow-neutral-700 h-16">
    <div class="grid grid-cols-12">
        <div class="col-start-2 col-span-2 lg:col-start-3 lg:col-span-2 flex justify-start items-center h-16">
            <a class="text-2xl italic text-cyan-500 align-content-center" href="/">website</a>
        </div>
        <div class="col-start-5 col-span-6">
            <div class="flex justify-start items-center h-16">
                <button id="hamburger" name="hamburger" type="button" class="block absolute right-12 lg:hidden aria-label="Toggle navigation">
                    <span class="hamburger-line transsition duration-300 ease-in out origin-top-left bg-white"></span>
                    <span class="hamburger-line transsition duration-300 ease-in out bg-white"></span>
                    <span class="hamburger-line transsition duration-300 ease-in out origin-bottom-left bg-white"></span>
                </button>
                <navbar id="nav-menu" class="hidden absolute bg-neutral-900 p-3 opacity-50 shadow rounded max-w-[200px] w-full right-0 top-full lg:flex lg:justify-end lg:static lg:bg-transparent lg:max-w-full lg:shadow-none lg:rounded-none">
                    <ul class="block justify-center items-center lg:flex">
                        <li><a class="text-base text-white mx-3 flex hover:text-cyan-500 {{ Request::is('/') ? 'text-cyan-500' : '' }}" href="/">Home</a></li>
                        <li><a class="text-base text-white mx-3 flex hover:text-cyan-500 {{ Request::is('dashboard') ? 'text-cyan-500' : '' }}" href="/dashboard">Lihat Kontes</a></li>
                        @auth
                          <li><a class="text-base text-white mx-3 flex hover:text-cyan-500 {{ Request::is('fortopolio') ? 'text-cyan-500' : '' }}" href="/fortopolio">Fortopolio</a></li>
                          <li><a class="text-base text-white mx-3 flex hover:text-cyan-500 {{ Request::is('user') ? 'text-cyan-500' : '' }}" href="/user">My Profile</a></li>
                          <li>
                            <form class="text-base text-white mx-3 hover:text-cyan-500 my-0" action="/logout" method="post">
                              @csrf
                              <button type ="submit">logout</button>
                            </form>
                          </li>
                        @else
                          <li ><a class="text-base text-white mx-3 flex hover:text-cyan-500  {{ Request::is('signin') ? 'text-cyan-500' : '' }}" href="/signin">Login</a></li>    
                        @endauth
                      </ul>                      
                </navbar>
            </div>
        </div>
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