@extends('layouts.layout')

@section('content')
    <div class="flex w-full justify-between lg:flex-row flex-col px-6 lg:px-32 py-5 items-center relative z-[0]">
        <img src="{{ asset('assets/images/hero/bg-1.png') }}"
            class="absolute top-0 left-0 min-h-[50vh] lg:min-h-[unset] w-[1000px] object-cover lg:w-full z-[-1] pointer-events-none"
            alt="">
        <img src="{{ asset('assets/images/hero/bg-2.png') }}"
            class="absolute top-0 left-0 min-h-[50vh] lg:min-h-[unset] w-[1000px] object-cover lg:w-full z-[-1] pointer-events-none"
            alt="">
        <div class="flex flex-col z-[1] lg:order-1 order-2">
            <h1 class="text-4xl 2xl:text-5xl font-bold">Jadilah Developer <br>
                Handal dengan <span class="relative inline-flex flex-col overflow-hidden">Edutorium !<img
                        src="{{ asset('assets/images/hero/underline.svg') }}" class="w-fit" alt=""></span></h1>
            <h4 class="text-xl font-semibold">Dari <span class="relative inline-flex flex-col overflow-hidden">Zero<img
                        src="{{ asset('assets/images/hero/underline-hero.svg') }}" class="w-fit" alt=""></span> to
                <span class="relative inline-flex flex-col overflow-hidden">Hero<img
                        src="{{ asset('assets/images/hero/underline-hero.svg') }}" class="w-fit" alt=""></span>,
                Bootcamp dan Real-Time Coding hanya di Edutorium!
            </h4>
            <button class="btn-fill w-fit mt-10 hover:bg-primary-800 hover:text-white">Belajar Sekarang!</button>
        </div>
        <div id="lottie-container" class="w-1/2 2xl:w-2/5 object-cover z-[1] order-1 lg:order-2"></div>
    </div>
    <div class="px-6 lg:px-32 z-[10] relative">
        <div class="flex flex-col lg:items-center justify-center py-10">
            <p class="text-xl font-medium">Mengapa
                <span class="text-blue-500">edutorium</span>?
            </p>
            <h2 class="text-5xl font-bold">Fitur yang ada di Edutorium</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-5 my-10 2xl:px-20">
                <div class="flex flex-col gap-3 px-5 py-5 bg-white shadow-xl rounded-xl">
                    <img src="{{ asset('assets/images/icons/fitur-1.svg') }}" class="w-10 h-10" alt="">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xl font-semibold">Bootcamp</h1>
                        <p>Pembelajaran yang dilakukan berbasis Bootcamp.</p>
                    </div>
                </div>
                <div class="flex flex-col gap-3 px-5 py-5 bg-white shadow-xl rounded-xl">
                    <img src="{{ asset('assets/images/icons/fitur-2.svg') }}" class="w-10 h-10" alt="">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xl font-semibold">Live Code</h1>
                        <p>Fitur Live Code sebagai implementasi Pembelajaran.</p>
                    </div>
                </div>
                <div class="flex flex-col gap-3 px-5 py-5 bg-white shadow-xl rounded-xl">
                    <img src="{{ asset('assets/images/icons/fitur-3.svg') }}" class="w-10 h-10" alt="">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xl font-semibold">Portfolio</h1>
                        <p>Mempunyai portfolio sebagai seorang progammer IT.</p>
                    </div>
                </div>
                <div class="flex flex-col gap-3 px-5 py-5 bg-white shadow-xl rounded-xl">
                    <img src="{{ asset('assets/images/icons/fitur-4.svg') }}" class="w-10 h-10" alt="">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xl font-semibold">Materi</h1>
                        <p>Materi yang digunakan telah terupdate.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-6 lg:px-32 flex lg:flex-row flex-col justify-between items-center">
        <div id="lottie-2" class="lg:w-1/2"></div>
        <div class="flex flex-col lg:w-1/2 gap-5">
            <h1 class="text-5xl font-bold">Belajar Koding itu <span class="text-primary-900">Mudah</span></h1>
            <p class="text-xl font-medium">Dengan metode praktis dan interaktif kami, Kamu akan cepat memahami konsep
                pemrograman. Setiap langkah disertai contoh nyata dan latihan secara langsung.</p>
        </div>
    </div>
    <div class="px-6 lg:px-32 flex lg:flex-row flex-col justify-between items-center">
        <div class="flex flex-col lg:w-1/2 gap-5 lg:order-1 order-2">
            <h1 class="text-5xl font-bold">Live <span class="text-primary-900">Coding</span></h1>
            <p class="text-xl font-medium">Fitur LiveCoding akan memudahkan kamu dalam mempelajarai code secara langsung.
                sehingga kamu tidak hanya mempelajari saja tetapi dapat langsung mengimplementasikan kode secara langsung
                disini!
            </p>
        </div>
        <div id="lottie-3" class="lg:w-2/5 order-1 lg:order-2"></div>
    </div>
    <div class="px-6 lg:px-32 flex flex-col lg:items-center mt-10">
        <h1 class="text-5xl font-bold">Portfolio Siswa <span class="text-primary-900">Edutorium</span></h1>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 w-full gap-8 my-10">
            @for ($i = 0; $i < 9; $i++)
                <div class="flex flex-col bg-white shadow-2xl rounded-xl overflow-hidden hover:scale-105 transition-all ease-in-out duration-300">
                    <img src="{{ asset('assets/images/hero/default.png') }}" class="max-h-48 w-full object-cover"
                        alt="">
                    <div class="flex flex-col gap-px px-5 py-4">
                        <h1 class="text-lg font-semibold">Ahmad Akbar</h1>
                        <p class="text-sm">12 Juni 2024.</p>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var animation = lottie.loadAnimation({
            container: document.getElementById('lottie-container'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '{{ asset('assets/images/lottie/hero-4.json') }}' // Ganti dengan path file Lottie JSON kamu
        });
        var animation2 = lottie.loadAnimation({
            container: document.getElementById('lottie-2'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '{{ asset('assets/images/lottie/hero-mudah.json') }}' // Ganti dengan path file Lottie JSON lainnya
        });
        var animation3 = lottie.loadAnimation({
            container: document.getElementById('lottie-3'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '{{ asset('assets/images/lottie/live-code.json') }}' // Ganti dengan path file Lottie JSON lainnya
        });
    </script>
@endpush
