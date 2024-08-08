<!-- Modal HTML untuk Lengkapi Profil -->
<div id="profileModal" class="hidden fixed z-10 inset-0 overflow-y-auto transition-opacity ease-in-out duration-300">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity ease-in-out duration-300" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75 transition-all ease-in-out duration-300"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div id="profileModalContent"
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all ease-in-out duration-300 sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full opacity-0 translate-y-4 blur-sm">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 w-full">
                <div class="sm:flex flex-col sm:items-start w-full">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <div class="flex items-center gap-2">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i data-feather="info"></i>
                            </div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="profileModalTitle">
                                Lengkapi Profil Anda
                            </h3>
                        </div>
                        <div class="mt-2 relative">
                            <p class="text-sm text-gray-500">
                                Untuk pengalaman yang lebih baik, silakan lengkapi profil Anda.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        id="close-profile-modal">
                        Lengkapi Profil
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        feather.replace();

        const isProfileEmpty = @json($isProfileEmpty);
        const profileModal = document.getElementById('profileModal');
        const profileModalContent = document.getElementById('profileModalContent');
        const closeProfileBtn = document.getElementById('close-profile-modal');

        if (isProfileEmpty) {
            showProfileModal();
        }

        function showProfileModal() {
            profileModal.classList.remove('hidden');
            setTimeout(() => {
                profileModalContent.classList.remove('opacity-0', 'translate-y-4', 'blur-sm');
                profileModalContent.classList.add('opacity-100', 'translate-y-0', 'blur-none');
            }, 10); // delay for smooth transition
        }

        closeProfileBtn.addEventListener('click', () => {
            window.location.href = "{{ route('user.profile.edit') }}";
        });
    });
</script>
