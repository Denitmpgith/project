<nav class="navbar fixed-top navbar-expand-lg" style="background-color: rgb(125,125,125)">
    <div class="container">
        <a class="navbar-brand fw-bold fst-italic" href="/">website contest</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a></li>
                @auth
                <li class="nav-item dropdown {{ Request::is('signin') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ auth()->User()->username }}</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/dashboard">lihat Kontes</a></li>
                        <li><a class="dropdown-item" href="#">Buat Kontes</a></li>
                        <li><a class="dropdown-item" href="/fortopolio">fortopolio</a></li>
                        <li><a class="dropdown-item" href="/user">my Profile</a></li>
                        <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button type ="submit" class="dropdown-item">logout</button>
                        </form>
                    </ul>
                </li>
                @else
                <li class="nav-item"><a class="nav-link {{ Request::is('signin') ? 'active' : '' }}" href="/signin">Login</a></li>    
                @endauth
            </ul>
        </div>
    </div>
</nav>