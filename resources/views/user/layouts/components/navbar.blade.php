<nav class="navbar-vertical navbar">
    <div id="myScrollableElement" class="h-screen" data-simplebar>
        <!-- brand logo -->
        <a class="navbar-brand" href="./index.html">
            {{-- <img src="{{ asset('assets/images/brand/logo/logo.svg') }}" alt="" /> --}}
            <h1 class="text-2xl text-white font-bold">edutorium</h1>
        </a>

        <!-- navbar nav -->
        <ul class="navbar-nav flex-col" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"
                    href="{{ route('user.dashboard') }}">
                    <i data-feather="home" class="w-4 h-4 mr-2"></i>
                    Dashboard
                </a>
            </li>
            <!-- nav item -->
            <li class="nav-item">
                <div class="navbar-heading">FEATURES</div>
            </li>
            <!-- nav item -->
            <li class="nav-item">
                <a class="nav-link  collapsed" href="#!" data-bs-toggle="collapse" data-bs-target="#bootcamp"
                    aria-expanded="false" aria-controls="bootcamp">
                    <i data-feather="zap" class="w-4 h-4 mr-2"></i>
                    Bootcamp
                </a>
                <div id="bootcamp" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-col">
                        <li class="nav-item">
                            <a class="nav-link flex gap-1 " href="{{ route('user.bootcamp.modul.modul') }}">
                                <i data-feather="columns" class="w-4 h-4 mr-2"></i>
                                Modul
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link flex gap-1 " href="{{ route('user.livecoding.index') }}">
                                <i data-feather="code" class="w-4 h-4 mr-2"></i>
                                LiveCode
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link flex gap-1" href="{{ route('user.quiz.index') }}">
                                <i data-feather="edit-2" class="w-4 h-4 mr-2"></i>
                                Quiz
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link flex gap-1" href="{{ route('user.tugas-akhir.index') }}">
                                <i data-feather="star" class="w-4 h-4 mr-2"></i>
                                Tugas Akhir
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- nav item -->
            {{-- <li class="nav-item">
                <a class="nav-link" href="#">
                    <i data-feather="clipboard" class="w-4 h-4 mr-2"></i>
                    Portfolio
                </a>
            </li> --}}
            <!-- nav item -->
            <li class="nav-item">
                <div class="navbar-heading">Akun</div>
            </li>

            <!-- nav item -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('user.profile.index') ? 'active' : '' }}"
                    href="{{ route('user.profile.index') }}">
                    <i data-feather="user" class="w-4 h-4 mr-2"></i>
                    Profil
                </a>
            </li>
        </ul>
    </div>
</nav>

{{-- <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('bootcamp.*') ? 'active' : '' }} collapsed" href="#!"
        data-bs-toggle="collapse" data-bs-target="#bootcamp" aria-expanded="false" aria-controls="bootcamp">
        <i data-feather="zap" class="w-4 h-4 mr-2"></i>
        Bootcamp
    </a>
    <div id="bootcamp" class="collapse {{ request()->routeIs('bootcamp.*') ? 'show' : '' }}"
        data-bs-parent="#sideNavbar">
        <ul class="nav flex-col">
            <li class="nav-item">
                <a class="nav-link flex gap-1 {{ request()->routeIs('bootcamp.modul') ? 'active' : '' }}"
                    href="{{ route('bootcamp.modul') }}">
                    <i data-feather="columns" class="w-4 h-4 mr-2"></i>
                    Modul
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link flex gap-1 {{ request()->routeIs('bootcamp.livecode') ? 'active' : '' }}"
                    href="{{ route('bootcamp.livecode') }}">
                    <i data-feather="code" class="w-4 h-4 mr-2"></i>
                    LiveCode
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link flex gap-1 {{ request()->routeIs('bootcamp.quiz') ? 'active' : '' }}"
                    href="{{ route('bootcamp.quiz') }}">
                    <i data-feather="edit-2" class="w-4 h-4 mr-2"></i>
                    Quiz
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link flex gap-1 {{ request()->routeIs('bootcamp.tugasakhir') ? 'active' : '' }}"
                    href="{{ route('bootcamp.tugasakhir') }}">
                    <i data-feather="star" class="w-4 h-4 mr-2"></i>
                    Tugas Akhir
                </a>
            </li>
        </ul>
    </div>
</li>
<!-- nav item -->
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('portfolio') ? 'active' : '' }}"
        href="{{ route('portfolio') }}">
        <i data-feather="clipboard" class="w-4 h-4 mr-2"></i>
        Portfolio
    </a>
</li> --}}
