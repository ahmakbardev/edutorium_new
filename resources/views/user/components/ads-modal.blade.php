<div id="customModal"
    class="fixed inset-0 z-50 flex items-center justify-center overflow-y-hidden bg-black bg-opacity-50 transition-opacity duration-300 hidden opacity-0">
    <div
        class="modal-content bg-white rounded-lg w-5/6 h-5/6 px-3 py-5 md:px-8 md:py-8 transform translate-y-16 opacity-0 transition-transform duration-300 ease-in-out">
        <!-- Konten modal -->
        <div
            class="custom-art relative px-2 md:px-5 lg:px-0 max-lg:flex max-lg:flex-col grid place-content-center h-full gap-4">
            <div class="flex overflow-hidden justify-center items-center gap-3">
                <div class="swiper-container overflow-hidden lg:rounded-md group">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img class="w-full object-cover object-center"
                                src="{{ asset('assets/images/banner/HTML.png') }}" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img class="w-full object-cover object-center"
                                src="{{ asset('assets/images/banner/HTML.png') }}" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img class="w-full object-cover object-center"
                                src="{{ asset('assets/images/banner/HTML.png') }}" alt="">
                        </div>
                        <!-- Tambahkan lebih banyak gambar sesuai kebutuhan -->
                    </div>
                    <!-- Indikator Carousel -->
                    <div class="relative mx-auto w-full lg:w-1/2">
                        <div class=" absolute flex w-full">
                            <div class="swiper-pagination w-fit"></div>
                        </div>
                    </div>
                    <!-- Jika Anda ingin menambahkan navigasi prev/next -->
                    <div class="opacity-0 group-hover:opacity-100 hidden md:block transition-all ease-in-out z-10">
                        <div
                            class="prev absolute left-2 xl:group-hover:-left-5 transition-all ease-in-out delay-75 top-1/2 transform group/pagination -translate-y-1/2 border border-primary-600 bg-white hover:bg-primary-600 hover:text-white text-primary rounded-full w-10 h-10 flex items-center justify-center cursor-pointer z-10">
                            <svg class="w-6 h-6 stroke-2 stroke-primary-600 group-hover/pagination:stroke-white transition-all ease-in-out"
                                fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="next absolute right-2 xl:group-hover:-right-5 transition-all ease-in-out delay-75 top-1/2 group/pagination transform -translate-y-1/2 border border-primary-600 bg-white hover:bg-primary-600 hover:text-white text-primary rounded-full w-10 h-10 flex items-center justify-center cursor-pointer z-10">
                            <svg class="w-6 h-6 stroke-2 stroke-primary-600 group-hover/pagination:stroke-white transition-all ease-in-out"
                                fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tombol close -->
            <button id="closeModalBtn"
                class="absolute top-0 right-0 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-full w-8 h-8 flex items-center justify-center focus:outline-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
    function showModal() {
        const customModal = document.getElementById('customModal');
        const modalContent = customModal.querySelector('.modal-content');
        customModal.classList.remove('hidden');
        setTimeout(function() {
            customModal.classList.add('opacity-100');
            modalContent.classList.add('translate-y-0', 'opacity-100');
            modalContent.style.transform = 'translateY(0)';
            document.body.classList.add('overflow-y-hidden');
        }, 50); // Tunggu 0.05 detik sebelum muncul secara smooth
    }

    function hideModal() {
        const customModal = document.getElementById('customModal');
        const modalContent = customModal.querySelector('.modal-content');
        document.body.classList.remove('overflow-y-hidden');

        modalContent.classList.remove('translate-y-0', 'opacity-100');
        modalContent.classList.add('translate-y-full');

        modalContent.style.transform = 'translateY(100%)';

        setTimeout(function() {
            customModal.classList.remove('opacity-100');
            customModal.classList.add('opacity-0');
            setTimeout(function() {
                customModal.classList.add('hidden');
            }, 300); // Sesuaikan dengan durasi transition (0.3s)
        }, 300); // Sesuaikan dengan durasi transition (0.3s)
    }

    // Tampilkan modal hanya jika lebar layar minimum 768px
    if (window.innerWidth >= 768) {
        setTimeout(showModal, 1000);
    }

    // Tambahkan event listener untuk tombol close
    document.getElementById('closeModalBtn').addEventListener('click', hideModal);

    // Tambahkan event listener untuk menangani perubahan ukuran layar
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768 && document.getElementById('customModal').classList.contains('hidden')) {
            setTimeout(showModal, 1000);
        } else if (window.innerWidth < 768 && !document.getElementById('customModal').classList.contains(
                'hidden')) {
            hideModal();
        }
    });
</script>
<script>
    var mySwiper = new Swiper('.swiper-container', {
        loop: true,
        autoplayDisableOnInteraction: false,
        slidesPerView: 1,
        autoHeight: true,
        autoplay: {
            delay: 5000,
        },
        speed: 1000,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            type: 'bullets',
            renderBullet: function(index, className) {
                return '<span class="' + className + '">' +
                    '<i></i>' + '<b></b>' + '</span>';
            },
        },
        navigation: {
            nextEl: '.next',
            prevEl: '.prev',
        },
    });

    // Update listArray based on the number of carousel items
    var listArray = [];
    var carouselItems = document.querySelectorAll('.swiper-slide');
    carouselItems.forEach(function(item, index) {
        listArray.push("slide" + (index + 1));
    });

    mySwiper.on('slideChange', function() {
        var bullets = document.querySelectorAll('.swiper-pagination-bullet');
        bullets.forEach(function(bullet, index) {
            var isActive = index === mySwiper.realIndex;
            var progressBar = bullet.querySelector('b');
            if (isActive) {
                progressBar.style.backgroundColor = "#71DDFF";
                progressBar.style.width = '100%';
                progressBar.style.transition = 'width 5s ease-in-out';
            } else {
                progressBar.style.backgroundColor = "transparent";
                progressBar.style.width = '0%';
            }
            // Mengurangi ukuran dot secara menyeluruh ketika progress mencapai 100%
            bullet.style.width = isActive ? '8px' : '8px'; // Ukuran default dot
            bullet.style.transition = 'width 0.5s ease-in-out'; // Transisi smooth
        });
    });
</script>
