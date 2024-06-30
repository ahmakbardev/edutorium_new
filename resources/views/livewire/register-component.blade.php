<div class="p-2 lg:p-5 rounded-xl border w-full max-w-sm mx-auto">
    <h1 class="text-2xl font-semibold">Daftar Sekarang!</h1>
    <form wire:submit.prevent="register" class="mt-8 flex flex-col">
        <label for="name">Nama</label>
        <input type="text" name="name" placeholder="Masukkan namamu disini" wire:model="name"
            class="mb-3 outline-none rounded-lg border py-2 px-px md:px-3">
        @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Masukkan emailmu disini" wire:model="email"
            class="mb-3 outline-none rounded-lg border py-2 px-px md:px-3">
        @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <label for="password">Password</label>
        <div class="relative mb-3">
            <input type="password" name="password" placeholder="Masukkan passwordmu disini" wire:model="password"
                class="outline-none rounded-lg border py-2 px-px md:px-3 w-full">
            <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer"
                onclick="togglePasswordVisibility('password')">
                <i data-feather="eye"></i>
            </span>
        </div>
        @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <label for="password_confirmation">Konfirmasi Password</label>
        <div class="relative mb-3">
            <input type="password" name="password_confirmation" placeholder="Konfirmasi passwordmu disini"
                wire:model="password_confirmation" class="outline-none rounded-lg border py-2 px-px md:px-3 w-full">
            <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer"
                onclick="togglePasswordVisibility('password_confirmation')">
                <i data-feather="eye"></i>
            </span>
        </div>
        @error('password_confirmation')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <button type="submit" class="btn-fill mt-8">Daftar Sekarang</button>
    </form>
    <p class="mt-2 text-sm">Sudah memiliki akun? <a href="{{ route('login') }}"
            class="text-primary-900 hover:border-b transition-all ease-in-out hover:font-semibold">Login</a></p>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('register-success', event => {
                setTimeout(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registrasi Berhasil',
                        text: 'Registrasi berhasil! Anda akan diarahkan ke halaman login.',
                    });
                }, 1000);

                setTimeout(() => {
                    window.location.href = "{{ route('login') }}";
                }, 3000);
            });

            window.addEventListener('register-error', event => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Daftar Gagal! Pastikan datamu sudah benar',
                });
            });
        });

        function togglePasswordVisibility(fieldId) {
            const field = document.querySelector(`input[name=${fieldId}]`);
            const icon = field.nextElementSibling.querySelector('i');
            if (field.type === "password") {
                field.type = "text";
                icon.setAttribute("data-feather", "eye-off");
            } else {
                field.type = "password";
                icon.setAttribute("data-feather", "eye");
            }
            feather.replace();
        }
    </script>
</div>
