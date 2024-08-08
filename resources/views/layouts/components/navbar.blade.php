<header class="top-0 sticky z-[50] bg-white">
    <nav class="sticky w-full py-3 px-6 md:px-32 shadow-md flex justify-between items-center">
        <div class="flex gap-1 items-center">
            <img class="w-10 h-10" src="{{ asset('assets/images/logo/logo_edu.png') }}" alt="">
            <h4 class="font-medium">edutorium</h4>
        </div>
        <div class="hidden md:flex gap-5 items-center">
            <ul class="flex gap-5 items-center">
                <li class="text-sm">Beranda</li>
                <li class="text-sm"> <a href="{{ route('user.bootcamp.modul.modul') }}">Bootcamp</a></li>
                {{-- <li class="text-sm">Tentang</li> --}}
            </ul>
        </div>
        <div class="hidden md:flex gap-1 items-center">
            <a href="{{ route('login') }}" class="btn-fill text-sm">Belajar Sekarang!</a>
        </div>
        <div class="md:hidden flex items-center">
            <button id="menuBtn" class="text-gray-500 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>
    </nav>
    <div id="mobileMenu"
        class="fixed inset-0 bg-white z-40 transform translate-y-full transition-transform duration-300 ease-in-out">
        <div class="flex justify-between items-center px-6 py-4 shadow-md">
            <h4 class="font-medium">edutorium</h4>
            <button id="closeMenuBtn" class="text-gray-500 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <ul class="flex flex-col gap-4 px-6 py-4">
            <li class="text-sm">Beranda</li>
            <li class="text-sm">Bootcamp</li>
        </ul>
        <div class="flex items-center px-6 py-4">
            <a href="{{ route('login') }}" class="btn-fill text-sm w-full text-center">Belajar Sekarang!</a>
        </div>
    </div>
</header>

<script>
    document.getElementById('menuBtn').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.remove('translate-y-full');
        mobileMenu.classList.add('translate-y-0');
    });

    document.getElementById('closeMenuBtn').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.remove('translate-y-0');
        mobileMenu.classList.add('translate-y-full');
    });
</script>
