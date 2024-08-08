<div id="tugasAkhirModal" class="fixed z-10 inset-0 overflow-y-auto transition-opacity ease-in-out duration-300 hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity ease-in-out duration-300" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75 transition-all ease-in-out duration-300"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div id="tugasAkhirModalContent"
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all ease-in-out duration-300 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full opacity-0 translate-y-4 blur-sm">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i data-feather="info"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Tugas Akhir</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Selamat! Anda telah menyelesaikan semua modul. Sekarang Anda bisa melanjutkan ke tugas
                                akhir.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
                    id="close-tugasAkhir-modal">
                    Kerjakan Sekarang!
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        feather.replace();

        // Tampilkan modal tugas akhir jika flag showTugasAkhirModal true
        @if ($showTugasAkhirModal)
            const tugasAkhirModal = document.getElementById('tugasAkhirModal');
            const tugasAkhirModalContent = document.getElementById('tugasAkhirModalContent');
            showTugasAkhirModal();

            function showTugasAkhirModal() {
                tugasAkhirModal.classList.remove('hidden');
                setTimeout(() => {
                    tugasAkhirModalContent.classList.remove('opacity-0', 'translate-y-4', 'blur-sm');
                    tugasAkhirModalContent.classList.add('opacity-100', 'translate-y-0', 'blur-none');
                }, 10); // delay for smooth transition
            }

            document.getElementById('close-tugasAkhir-modal').addEventListener('click', () => {
                tugasAkhirModalContent.classList.add('opacity-0', 'translate-y-4', 'blur-sm');
                tugasAkhirModalContent.classList.remove('opacity-100', 'translate-y-0', 'blur-none');
                setTimeout(() => {
                    tugasAkhirModal.classList.add('hidden');
                    window.location.href = "{{ route('user.tugas-akhir.index') }}";
                }, 300); // match the duration of the animation
            });
        @endif
    });
</script>
