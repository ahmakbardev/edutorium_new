<div class="p-2 lg:p-5 rounded-xl border w-full max-w-sm mx-auto">
    <h1 class="text-2xl font-semibold">Login disini!</h1>
    @if (session()->has('error'))
        <div class="text-red-500 text-sm mt-2">{{ session('error') }}</div>
    @endif
    @if (session()->has('success'))
        <div class="text-green-500 text-sm mt-2">{{ session('success') }}</div>
    @endif
    <form wire:submit.prevent="login" class="mt-8 flex flex-col">
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
        <button type="submit" class="btn-fill mt-8">Masuk Sekarang</button>
    </form>
    <p class="mt-2 text-sm">Belum memiliki akun? <a href="{{ route('daftar') }}"
            class="text-primary-900 hover:border-b transition-all ease-in-out hover:font-semibold">Daftar</a></p>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('login-success', event => {
                // console.log('Success message:', {{ session('success') }});
                setTimeout(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Berhasil',
                        text: 'Login berhasil! Anda akan diarahkan ke dashboard.',
                    });
                }, 1000);

                setTimeout(() => {
                    window.location.href = "{{ route('user.dashboard') }}";
                }, 2000);
            });

            window.addEventListener('login-error', event => {
                // console.log('Error message:', {{ session('error') }});
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Email atau password salah.',
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
