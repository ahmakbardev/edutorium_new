<div class="p-6">
    <div class="card shadow">
        <!-- card body -->
        <div class="card-body">
            <h1 class="text-2xl font-semibold mb-4">Edit Profil</h1>

            @if (session()->has('message'))
                <div class="text-green-500 mb-4">{{ session('message') }}</div>
            @endif

            <form wire:submit.prevent="updateProfile" class="space-y-4">
                <div>
                    <label for="pic" class="block text-gray-700">Foto Profil</label>
                    <input type="file" id="pic" wire:model="pic"
                        class="block w-full mt-1 p-2 border border-gray-300 rounded">
                    @error('pic')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    @if ($pic && !is_string($pic))
                        <img src="{{ $pic->temporaryUrl() }}" alt="Preview" class="mt-2 w-20 h-20 rounded-full">
                    @elseif(Auth::user()->pic)
                        <img src="{{ asset('storage/' . Auth::user()->pic) }}" alt="Profile Pic"
                            class="mt-2 w-20 h-20 rounded-full">
                    @endif
                </div>
                <div>
                    <label for="name" class="block text-gray-700">Nama</label>
                    <input type="text" id="name" wire:model="name"
                        class="block w-full mt-1 p-2 border border-gray-300 rounded">
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" wire:model="email"
                        class="block w-full mt-1 p-2 border border-gray-300 rounded">
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="bio" class="block text-gray-700">Bio</label>
                    <textarea id="bio" wire:model="bio" class="block w-full mt-1 p-2 border border-gray-300 rounded"></textarea>
                    @error('bio')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-gray-700">Nomor Telepon</label>
                    <input type="number" id="phone" wire:model="phone"
                        class="block w-full mt-1 p-2 border border-gray-300 rounded">
                    @error('phone')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="sekolah" class="block text-gray-700">Sekolah</label>
                    <input type="text" id="sekolah" wire:model="sekolah"
                        class="block w-full mt-1 p-2 border border-gray-300 rounded">
                    @error('sekolah')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="kelas" class="block text-gray-700">Kelas</label>
                    <input type="text" id="kelas" wire:model="kelas"
                        class="block w-full mt-1 p-2 border border-gray-300 rounded">
                    @error('kelas')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="jurusan" class="block text-gray-700">Jurusan</label>
                    <input type="text" id="jurusan" wire:model="jurusan"
                        class="block w-full mt-1 p-2 border border-gray-300 rounded">
                    @error('jurusan')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="tgl_lahir" class="block text-gray-700">Tanggal Lahir</label>
                    <input type="date" id="tgl_lahir" wire:model="tgl_lahir"
                        class="block w-full mt-1 p-2 border border-gray-300 rounded">
                    @error('tgl_lahir')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.addEventListener('profile-updated', event => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Profil berhasil diperbarui.',
            });

            setTimeout(() => {
                window.location.href = "{{ route('user.dashboard') }}";
            }, 2000);
        });
    </script>
</div>
