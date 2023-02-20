<nav class="navbar fixed-top navbar-expand-lg" style="background-color: rgb(125,125,125)">
    <div class="container">
        <a class="navbar-brand fw-bold fst-italic" href="/">website contest</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">HOME</a></li>
                <li class="nav-item"><a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">DASHBOARD</a></li>
                <li class="nav-item"><a class="nav-link {{ Request::is('user') ? 'active' : '' }}" href="/user">USER</a></li>
                <li class="nav-item"><a class="nav-link {{ Request::is('signin') ? 'active' : '' }}" href="/signin">signin</a></li>
                {{-- <li class="nav-item dropdown {{ Request::is('signin') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">LOG IN</a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Dashboard</a></li>
                    <li><a class="dropdown-item" href="#">Buat Kontes</a></li>
                    <li><a class="dropdown-item" href="#">Ikut Kontes</a></li>
                    <li><a class="dropdown-item" href="/fortopolio">fortopolio</a></li>
                    <li><a class="dropdown-item" href="/signup">register</a></li>
                    <li><a class="dropdown-item" href="/signin">login</a></li>
                    <li><a class="dropdown-item" href="#">logout</a></li>
                    </ul>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>