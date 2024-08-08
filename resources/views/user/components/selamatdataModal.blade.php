<!-- Splide.js CSS and JS CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/css/splide.min.css">
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.9/dist/js/splide.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.6/lottie.min.js"></script>

<!-- Modal HTML untuk Selamat Datang -->
<div id="selamatdatangModal"
    class="hidden fixed z-10 inset-0 overflow-y-auto transition-opacity ease-in-out duration-300">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity ease-in-out duration-300" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75 transition-all ease-in-out duration-300"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div id="selamatdatangModalContent"
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all ease-in-out duration-300 sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full opacity-0 translate-y-4 blur-sm">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 w-full">
                <div class="sm:flex flex-col sm:items-start w-full">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <div class="flex items-center gap-2">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i data-feather="info"></i>
                            </div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="selamatdatangModalTitle">
                                Selamat Datang
                            </h3>
                        </div>
                        <div class="mt-2 relative">
                            <div class="splide splide-selamatdatang relative">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        <li class="splide__slide px-20 py-5 h-fit">
                                            <h5 class="text-2xl font-semibold text-center">Selamat Datang di Edutorium
                                            </h5>
                                            <div id="lottie-welcome" class="w-full h-96"></div>
                                            <h5 class="text-xl font-semibold text-center">Baca Tutorial Edutorium ini
                                                terlebih dahulu</h5>
                                        </li>
                                        <li class="splide__slide px-20 py-5 h-fit">
                                            <h5 class="text-2xl font-semibold text-center">Selesaikan Materi</h5>
                                            <p class="text-center">Mulailah dengan mempelajari semua materi yang telah
                                                disediakan untuk mendapatkan pemahaman yang kuat.</p>
                                            <div id="lottie-materi" class="w-full h-72"></div>
                                        </li>
                                        <li class="splide__slide px-20 py-5 h-fit">
                                            <h5 class="text-2xl font-semibold text-center">Lanjutkan dengan Livecode
                                            </h5>
                                            <p class="text-center">Setelah menyelesaikan materi, lanjutkan dengan
                                                latihan livecode untuk menguji keterampilan pemrograman Anda secara
                                                praktis.</p>
                                            <div id="lottie-livecode" class="w-full h-72"></div>
                                        </li>
                                        <li class="splide__slide px-20 py-5 h-fit">
                                            <h5 class="text-2xl font-semibold text-center">Kerjakan Quiz</h5>
                                            <p class="text-center">Kerjakan quiz untuk mengukur pemahaman Anda terhadap
                                                materi yang telah dipelajari.</p>
                                            <div id="lottie-quiz" class="w-full h-72"></div>
                                        </li>
                                        <li class="splide__slide px-20 py-5 h-fit">
                                            <h5 class="text-2xl font-semibold text-center">Selesaikan Proyek Akhir</h5>
                                            <p class="text-center">Sebagai penutup, selesaikan proyek akhir yang telah
                                                disiapkan untuk Anda. Ini akan membantu Anda mengaplikasikan semua yang
                                                telah dipelajari.</p>
                                            <div id="lottie-project" class="w-full h-72"></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="splide__arrows relative">
                                    {{-- <button class="splide__arrow splide__arrow--prev">Previous</button>
                                    <button class="splide__arrow splide__arrow--next">Next</button> --}}
                                </div>
                                {{-- <div class="splide__pagination"></div> --}}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        id="close-selamatdatang-modal">
                        Belajar Sekarang!
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Load Lottie Animation
        lottie.loadAnimation({
            container: document.getElementById('lottie-welcome'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '{{ asset('assets/images/lottie/school.json') }}' // Ganti dengan path ke file Lottie JSON kamu
        });
        lottie.loadAnimation({
            container: document.getElementById('lottie-materi'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '{{ asset('assets/images/lottie/materi.json') }}' // Ganti dengan path ke file Lottie JSON kamu
        });
        lottie.loadAnimation({
            container: document.getElementById('lottie-livecode'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '{{ asset('assets/images/lottie/live-code.json') }}' // Ganti dengan path ke file Lottie JSON kamu
        });
        lottie.loadAnimation({
            container: document.getElementById('lottie-quiz'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '{{ asset('assets/images/lottie/quiz.json') }}' // Ganti dengan path ke file Lottie JSON kamu
        });
        lottie.loadAnimation({
            container: document.getElementById('lottie-project'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '{{ asset('assets/images/lottie/code_modal.json') }}' // Ganti dengan path ke file Lottie JSON kamu
        });

        // Tampilkan modal selamatdatangModal jika showSelamatDatangModal true
        @if ($showSelamatDatangModal)
            const selamatdatangModal = document.getElementById('selamatdatangModal');
            const selamatdatangModalContent = document.getElementById('selamatdatangModalContent');
            showSelamatdatangModal();

            function showSelamatdatangModal() {
                selamatdatangModal.classList.remove('hidden');
                setTimeout(() => {
                    selamatdatangModalContent.classList.remove('opacity-0', 'translate-y-4', 'blur-sm');
                    selamatdatangModalContent.classList.add('opacity-100', 'translate-y-0',
                        'blur-none');
                }, 10); // delay for smooth transition
            }
        @endif

        const closeSelamatdatangBtn = document.getElementById('close-selamatdatang-modal');
        closeSelamatdatangBtn.addEventListener('click', () => {
            selamatdatangModalContent.classList.add('opacity-0', 'translate-y-4', 'blur-sm');
            selamatdatangModalContent.classList.remove('opacity-100', 'translate-y-0', 'blur-none');
            setTimeout(() => {
                selamatdatangModal.classList.add('hidden');
                window.location.href = "{{ route('user.bootcamp.modul.modul') }}";
            }, 300); // match the duration of the animation
        });

        // Slider Setup using Splide.js
        new Splide('.splide-selamatdatang', {
            type: 'loop',
            perPage: 1,
            pagination: true,
            arrows: true,
        }).mount();
    });
</script>
