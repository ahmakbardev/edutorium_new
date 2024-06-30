<div id="toastContainer"
    class="toast-container fixed top-0 right-0 p-3 transition transform translate-y-[-100%] opacity-0 z-[50]">
    <div id="liveToast" aria-live="assertive" aria-atomic="true"
        class="toast border border-gray-300 flex flex-col w-full max-w-xs text-white {{ $isEmpty ? 'bg-red-500' : 'bg-green-500' }}  rounded-lg"
        role="alert">
        <div class="flex items-center w-full px-3 pt-3">
            <h4 class="text-white">Edutorium</h4>
            <button type="button"
                class="btn-close ms-auto -mx-1.5 -my-1.5 text-white hover:text-gray-500 rounded-lg focus:ring-2 inline-flex items-center justify-center h-8 w-8"
                data-bs-dismiss="toast" aria-label="Close" onclick="hideToast()">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
        <div class="p-3">
            @if ($isEmpty)
                <p>Lengkapi Profil kamu agar ter<span class="font-bold">verifikasi!</span> Lengkapi profilmu sekarang</p>
            @else
                <p>Profil kamu telah ter<span class="font-bold">verifikasi</span>!</p>
            @endif
        </div>
    </div>
</div>
