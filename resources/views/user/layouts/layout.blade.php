<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width" />
    {{-- <meta name="description"
        content="Dash UI - TailwindCSS HTML Admin Template Free and open-source Github, provides developers with everything need to create Web Application & Kick start project" /> --}}
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo_edu.png') }}" type="image/x-icon">


    <!-- Libs CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" />
    <link rel="stylesheet" href="{{ asset('assets/libs/simplebar/dist/simplebar.min.css') }}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    <!-- Append version number to CSS file name -->
    <link rel="stylesheet" href="{{ asset('css/app.css?v=1.03') }}">
    <!-- Add cache-control headers for CSS and JavaScript files -->
    <link rel="preload" href="{{ asset('css/app.css?v=1.03') }}" as="style" crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ asset('assets/libs/apexcharts/dist/apexcharts.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    @livewireStyles


    <title>Edutorium</title>
</head>

<body>
    <main>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"
            integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.2/anime.min.js"
            integrity="sha512-aNMyYYxdIxIaot0Y1/PLuEu3eipGCmsEUBrUq+7aVyPGMFH8z0eTP0tkqAvv34fzN6z+201d3T8HPb1svWSKHQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <!-- start navbar -->
            @if (!in_array(Route::currentRouteName(), ['user.bootcamp.modul.materi', 'user.livecoding.show']))
                @include('user.layouts.components.navbar')
            @endif
            <!--end of navbar-->

            <!-- app layout content -->
            <div id="app-layout-content"
                class="min-h-screen w-full min-w-[100vw] md:min-w-0 {{ !in_array(Route::currentRouteName(), ['user.bootcamp.modul.materi', 'user.livecoding.show']) ? 'ml-[15.625rem]' : '' }} [transition:margin_0.25s_ease-out]">
                <!-- start navbar -->
                @include('user.layouts.components.header')
                <!-- end of navbar -->


                @yield('content')

                @include('user.layouts.components.footer')
                @include('user.layouts.components.toast')

            </div>
        </div>
        <!-- end of project -->
    </main>

    @include('user.layouts.components.scripts')
    @stack('scripts')
    @livewireScripts

</body>

</html>
