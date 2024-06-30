<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width" />
    <meta name="description"
        content="Dash UI - TailwindCSS HTML Admin Template Free and open-source Github, provides developers with everything need to create Web Application & Kick start project" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon/favicon.ico') }}" />

    <!-- Libs CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" />
    <link rel="stylesheet" href="{{ asset('assets/libs/simplebar/dist/simplebar.min.css') }}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/libs/apexcharts/dist/apexcharts.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Tambahkan di head section -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    @livewireStyles


    <title>Dash UI - TailwindCSS HTML Admin Template Free</title>
</head>

<body>
    <main>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <!-- start navbar -->
            @include('user.layouts.components.navbar')
            <!--end of navbar-->

            <!-- app layout content -->
            <div id="app-layout-content"
                class="min-h-screen w-full min-w-[100vw] md:min-w-0 ml-[15.625rem] [transition:margin_0.25s_ease-out]">
                <!-- start navbar -->
                @include('user.layouts.components.header')
                <!-- end of navbar -->


                @yield('content')

                @include('user.layouts.components.footer')

            </div>
        </div>
        <!-- end of project -->
    </main>

    @include('user.layouts.components.scripts')
    @stack('scripts')
    @livewireScripts

</body>

</html>
