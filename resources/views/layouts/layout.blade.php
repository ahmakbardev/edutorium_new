<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo_edu.png') }}" type="image/x-icon">
    <title>Edutorium</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.13/lottie.min.js"></script>

    @stack('assets')
    @livewireStyles
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (!in_array(Route::currentRouteName(), ['login', 'daftar']))
        @include('layouts.components.navbar')
    @endif
    @yield('content')

    @stack('scripts')
    <script>
        feather.replace();
    </script>
    @livewireScripts
</body>

</html>
