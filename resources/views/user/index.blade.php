@extends('user.layouts.layout')

@section('content')
    <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-end mb-3">
        <div class="flex flex-col gap-3">

            @include('user.components.breadcrumb')
            <!-- title -->
            <h1 class="text-3xl text-white group">Selamat Datang <span
                    class="font-semibold border-b hover:border-b-2 transition-all ease-in-out cursor-default group-hover:text-4xl">Ahmad
                    Akbar
                    M</span> !</h1>
        </div>
        <a href="#"
            class="btn bg-white text-gray-800 hover:bg-gray-100 hover:text-gray-800 hover:border-gray-200 active:bg-gray-100 active:text-gray-800 active:border-gray-200 focus:outline-none focus:ring-4 focus:ring-indigo-300">
            Belajar Sekarang
        </a>

    </div>
    @if (session('just_logged_in'))
        @include('user.components.ads-modal')
        {{ session()->forget('just_logged_in') }} <!-- Remove the session after displaying the modal -->
    @endif
    <div class="-mt-10 mx-6 grid grid-cols-1 xl:grid-cols-3 grid-rows-1 grid-flow-row-dense gap-6">
        <div class="xl:col-span-2">
            <div class="card h-full shadow">
                <!-- heading -->
                <div class="border-b border-gray-300 px-5 py-4">
                    <h4 class="text-base">Tabel Rangking <span class="font-semibold">Edutorium</span></h4>
                </div>

                <div class="relative overflow-x-auto overflow-y-auto max-h-[458px]" data-simplebar="">
                    <!-- table -->
                    <table class="text-left w-full whitespace-nowrap">
                        <thead class="text-gray-700 sticky top-0">
                            <tr>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3 cursor-default">Nama
                                </th>
                                {{-- <th scope="col" class="border-b bg-gray-100 px-6 py-3 cursor-default">Sekolah</th> --}}
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3 cursor-default">Modul</th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3 cursor-default">
                                    <p class="w-fit" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Nilai Quiz">Quiz
                                    </p>
                                </th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3 cursor-default">
                                    <p class="w-fit" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Nilai Post Test">Post Test</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @foreach (range(1, 10) as $index)
                                <tr class="hover:bg-slate-100 transition-all ease-in-out">
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        <div class="flex items-center">

                                            <h5 class="mb-1"><a href="#!">Dropbox Design System</a>
                                            </h5>
                                        </div>
                                    </td>
                                    {{-- <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">34
                                </td> --}}
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        <span
                                            class="bg-green-200 px-2 py-1 text-green-700 text-xs font-medium rounded-full inline-block whitespace-nowrap text-center">HTML</span>
                                    </td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        100
                                    </td>
                                    <td class="border-b border-gray-300 py-3 px-6 pe-6 text-left">
                                        <div class="flex items-center gap-2">
                                            <div>15%</div>
                                            <div class="w-full bg-gray-200 rounded-full h-1.5">
                                                <div class="bg-indigo-600 h-1.5 rounded-full" style="width: 15%"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-100 transition-all ease-in-out">
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <h5 class="><a href="#!">Webapp Design System</a></h5>
                                        </div>
                                    </td>
                                    {{-- <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">89
                                </td> --}}
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        <span
                                            class="bg-green-200 px-2 py-1 text-green-700 text-xs font-medium rounded-full inline-block whitespace-nowrap text-center">CSS</span>
                                    </td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        100
                                    </td>
                                    <td class="border-b border-gray-300 py-3 px-6 pe-6 text-left">
                                        <div class="flex items-center gap-2">
                                            <div>100%</div>
                                            <div class="w-full bg-gray-200 rounded-full h-1.5">
                                                <div class="bg-green-600 h-1.5 rounded-full" style="width: 100%"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-100 transition-all ease-in-out">
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <h5 class="><a href="#!">Github Event Design</a></h5>
                                        </div>
                                    </td>
                                    {{-- <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">120
                                </td> --}}
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        <span
                                            class="bg-green-200 px-2 py-1 text-green-700 text-xs font-medium rounded-full inline-block whitespace-nowrap text-center">Javascript</span>
                                    </td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        100
                                    </td>
                                    <td class="border-b border-gray-300 py-3 px-6 pe-6 text-left">
                                        <div class="flex items-center gap-2">
                                            <div>75%</div>
                                            <div class="w-full bg-gray-200 rounded-full h-1.5">
                                                <div class="bg-indigo-600 h-1.5 rounded-full" style="width: 75%"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- card -->
        <div class="card h-full shadow">
            <div class="border-b border-gray-300 px-5 py-4 flex justify-between items-center">
                <h4 class="text-base">Progres Kamu</h4>
                <!-- dropdown -->
                <div class="dropdown leading-4">
                    <button class="text-gray-600 p-1 hover:bg-gray-300 rounded-full transition-all" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i data-feather="more-vertical" class="w-4 h-4"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Edit Profil</a></li>
                        <li><a class="dropdown-item" href="#">Histori Bootcamp</a></li>
                        <li><a class="dropdown-item" href="#">Portfolio</a></li>
                    </ul>
                </div>
            </div>
            <!-- card body -->
            <div class="card-body overflow-hidden">
                <div class="w-full grid lg:grid-cols-2 gap-3">
                    <div
                        class="w-4/5 h-fit bg-slate-400 aspect-square rounded-full relative mx-auto flex justify-center items-center">
                        <img src="{{ Auth::user()->pic ? asset('storage/' . Auth::user()->pic) : asset('assets/images/profile/default-profile2.jpg') }}"
                            class="rounded-full border-[8px] w-full border-slate-400 hover:border-[10px] transition-all ease-in-out"
                            alt="User Profile Picture">
                        <img src="{{ $isEmpty ? asset('assets/images/svg/unchecked-mark.svg') : asset('assets/images/svg/checked-mark.svg') }}"
                            class="absolute top-0 right-0 w-10 aspect-square cursor-pointer hover:scale-110 hover:-translate-y-1 transition-all ease-in-out"
                            alt="" id="liveToastBtn">
                    </div>
                    @include('user.components.liveToastBtn', ['isEmpty' => $isEmpty])

                    <div class="flex flex-col gap-1">
                        <div class="flex flex-col pb-1 border-b border-slate-300">
                            <h4 class="label text-base">Nama:</h4>
                            <h1 class="text-lg font-semibold">{{ Auth::user()->name }}</h1>
                        </div>
                        <div class="flex flex-col py-1 border-b border-slate-300">
                            <h4 class="label text-base">Email:</h4>
                            <h1 class="text-lg font-semibold">{{ Auth::user()->email }}</h1>
                        </div>
                        <div class="flex flex-col py-1">
                            <h4 class="label text-base">Progres Terakhir:</h4>
                            <h1 class="text-lg font-semibold">HTML</h1>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-3 py-4">
                    <!-- content -->
                    <div class="text-center">
                        <div class="mb-3">
                            <i class="w-6 h-6 text-green-500 mx-auto" data-feather="bookmark"></i>
                        </div>

                        <p class="text-gray-600">Progress Modul</p>
                        <span class="text-2xl font-bold text-gray-800">100%</span>
                        <span
                            class="bg-green-200 w-fit mx-auto px-3 py-1 text-green-700 text-xs font-medium rounded-full block whitespace-nowrap text-center">Javascript</span>
                    </div>
                    <!-- content -->
                    <div class="text-center">
                        <div class="mb-3">
                            <i class="w-6 h-6 text-green-500 mx-auto" data-feather="book"></i>
                        </div>

                        <p class="text-gray-600">Progress Quiz</p>
                        <span class="text-2xl font-bold text-gray-800">32%</span>
                        <span
                            class="bg-yellow-200 w-fit mx-auto px-3 py-1 text-yellow-700 text-xs font-medium rounded-full block whitespace-nowrap text-center">CSS</span>
                    </div>
                    <!-- content -->
                    <div class="text-center">
                        <div class="mb-3">
                            <i class="w-6 h-6 text-green-500 mx-auto" data-feather="code"></i>
                        </div>
                        <p class="text-gray-600">Progress Coding</p>
                        <span class="text-2xl font-bold text-gray-800">0%</span>
                        <span
                            class="bg-red-200 w-fit mx-auto px-3 py-1 text-red-700 text-xs font-medium rounded-full block whitespace-nowrap text-center">HTML</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-6 grid grid-cols-1 grid-rows-1 mt-5 grid-flow-row-dense gap-6">
        <div class="">
            <div class="card h-full shadow">
                <!-- heading -->
                <div class="border-b border-gray-300 px-5 py-4">
                    <h4 class="text-base">Histori Pembelajaran</h4>
                </div>

                <div class="relative overflow-x-auto overflow-y-auto max-h-[400px]" data-simplebar="">
                    <!-- table -->
                    <table class="text-left w-full whitespace-nowrap">
                        <thead class="text-gray-700 sticky top-0">
                            <tr>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3">Modul
                                </th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3">Materi</th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3">Quiz</th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3">Post Test</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <div class="flex items-center">

                                        <h5 class="mb-1"><a href="#!">Dropbox Design System</a>
                                        </h5>
                                    </div>
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">34
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <span
                                        class="bg-yellow-200 px-2 py-1 text-yellow-700 text-sm font-medium rounded-full inline-block whitespace-nowrap text-center">Medium</span>
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <div class="-space-x-5">
                                        <img class="relative inline-block object-cover w-8 h-8 rounded-full border-white border-2"
                                            src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Profile image" />
                                        <img class="relative inline-block object-cover w-8 h-8 rounded-full border-white border-2"
                                            src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Profile image" />
                                        <img class="relative inline-block object-cover w-8 h-8 border-2 rounded-full border-white"
                                            src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Profile image" />
                                        <div
                                            class="relative w-8 h-8 bg-indigo-600 rounded-full inline-flex items-center justify-center text-white text-sm border-2 border-white">
                                            2+</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <h5 class="><a href="#!">Slack Team UI Design</a></h5>
                                    </div>
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">47
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <span
                                        class="bg-red-200 px-2 py-1 text-red-700 text-sm font-medium rounded-full inline-block whitespace-nowrap text-center">High</span>
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <div class="-space-x-5">
                                        <img class="relative inline-block object-cover w-8 h-8 rounded-full border-white border-2"
                                            src="{{ asset('assets/images/avatar/avatar-4.jpg') }}" alt="Profile image" />
                                        <img class="relative inline-block object-cover w-8 h-8 rounded-full border-white border-2"
                                            src="{{ asset('assets/images/avatar/avatar-5.jpg') }}" alt="Profile image" />
                                        <img class="relative inline-block object-cover w-8 h-8 border-2 rounded-full border-white"
                                            src="{{ asset('assets/images/avatar/avatar-6.jpg') }}" alt="Profile image" />
                                        <div
                                            class="relative w-8 h-8 bg-indigo-600 rounded-full inline-flex items-center justify-center text-white text-sm border-2 border-white">
                                            2+</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <h5 class="><a href="#!">GitHub Satellite</a></h5>
                                    </div>
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">120
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <span
                                        class="bg-cyan-200 px-2 py-1 text-cyan-700 text-sm font-medium rounded-full inline-block whitespace-nowrap text-center">Low</span>
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <div class="-space-x-5">
                                        <img class="relative inline-block object-cover w-8 h-8 rounded-full border-white border-2"
                                            src="{{ asset('assets/images/avatar/avatar-7.jpg') }}" alt="Profile image" />
                                        <img class="relative inline-block object-cover w-8 h-8 rounded-full border-white border-2"
                                            src="{{ asset('assets/images/avatar/avatar-8.jpg') }}" alt="Profile image" />
                                        <img class="relative inline-block object-cover w-8 h-8 border-2 rounded-full border-white"
                                            src="{{ asset('assets/images/avatar/avatar-9.jpg') }}" alt="Profile image" />
                                        <div
                                            class="relative w-8 h-8 bg-indigo-600 rounded-full inline-flex items-center justify-center text-white text-sm border-2 border-white">
                                            5+</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <h5 class="><a href="#!">3D Character Modelling</a>
                                        </h5>
                                    </div>
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">89
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <span
                                        class="bg-yellow-200 px-2 py-1 text-yellow-700 text-sm font-medium rounded-full inline-block whitespace-nowrap text-center">Medium</span>
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <div class="-space-x-5">
                                        <img class="relative inline-block object-cover w-8 h-8 rounded-full border-white border-2"
                                            src="{{ asset('assets/images/avatar/avatar-10.jpg') }}"
                                            alt="Profile image" />
                                        <img class="relative inline-block object-cover w-8 h-8 rounded-full border-white border-2"
                                            src="{{ asset('assets/images/avatar/avatar-11.jpg') }}"
                                            alt="Profile image" />
                                        <img class="relative inline-block object-cover w-8 h-8 border-2 rounded-full border-white"
                                            src="{{ asset('assets/images/avatar/avatar-12.jpg') }}"
                                            alt="Profile image" />
                                        <div
                                            class="relative w-8 h-8 bg-indigo-600 rounded-full inline-flex items-center justify-center text-white text-sm border-2 border-white">
                                            5+</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <h5 class="><a href="#!">Webapp Design System</a></h5>
                                    </div>
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">89
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <span
                                        class="bg-green-200 px-2 py-1 text-green-700 text-sm font-medium rounded-full inline-block whitespace-nowrap text-center">Track</span>
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <div class="-space-x-5">
                                        <img class="relative inline-block object-cover w-8 h-8 rounded-full border-white border-2"
                                            src="{{ asset('assets/images/avatar/avatar-13.jpg') }}"
                                            alt="Profile image" />
                                        <img class="relative inline-block object-cover w-8 h-8 rounded-full border-white border-2"
                                            src="{{ asset('assets/images/avatar/avatar-11.jpg') }}"
                                            alt="Profile image" />
                                        <img class="relative inline-block object-cover w-8 h-8 border-2 rounded-full border-white"
                                            src="{{ asset('assets/images/avatar/avatar-12.jpg') }}"
                                            alt="Profile image" />
                                        <div
                                            class="relative w-8 h-8 bg-indigo-600 rounded-full inline-flex items-center justify-center text-white text-sm border-2 border-white">
                                            5+</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <h5 class="><a href="#!">Github Event Design</a></h5>
                                    </div>
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">120
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <span
                                        class="bg-cyan-200 px-2 py-1 text-cyan-700 text-sm font-medium rounded-full inline-block whitespace-nowrap text-center">Low</span>
                                </td>
                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                    <div class="-space-x-5">
                                        <img class="relative inline-block object-cover w-8 h-8 rounded-full border-white border-2"
                                            src="{{ asset('assets/images/avatar/avatar-13.jpg') }}"
                                            alt="Profile image" />
                                        <img class="relative inline-block object-cover w-8 h-8 rounded-full border-white border-2"
                                            src="{{ asset('assets/images/avatar/avatar-11.jpg') }}"
                                            alt="Profile image" />
                                        <img class="relative inline-block object-cover w-8 h-8 border-2 rounded-full border-white"
                                            src="{{ asset('assets/images/avatar/avatar-12.jpg') }}"
                                            alt="Profile image" />
                                        <div
                                            class="relative w-8 h-8 bg-indigo-600 rounded-full inline-flex items-center justify-center text-white text-sm border-2 border-white">
                                            4+</div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-6 my-10 grid grid-cols-1 lg:grid-cols-2 grid-rows-1 grid-flow-row-dense gap-6">
        <div>
            <div class="card h-full shadow">
                <div class="border-b border-gray-300 px-5 py-4 flex items-center w-full justify-between">
                    <!-- title -->
                    <div>
                        <h4 class="font-semibold text-base">Portfolioku</h4>
                    </div>
                    <div>
                        <!-- button -->
                        <div class="dropdown leading-4">
                            <button
                                class="btn btn-sm gap-x-2 bg-white text-gray-800 border-gray-300 border disabled:opacity-50 disabled:pointer-events-none hover:text-white hover:bg-gray-700 hover:border-gray-700 active:bg-gray-700 active:border-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-300"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Buat Portfolio
                            </button>
                            <!-- list -->
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    <!-- cards -->
                    <div class="relative max-h-96 overflow-y-auto p-4" data-simplebar="">
                        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4">
                            @foreach (range(1, 10) as $index)
                                <div
                                    class="bg-white shadow-md rounded-md overflow-hidden flex flex-col hover:scale-105 hover:shadow-lg transition-all ease-in-out">
                                    <div class="block relative">
                                        <img src="{{ asset('assets/images/blog/blog-img-1.jpg') }}" alt="">
                                        <p
                                            class="absolute top-2 right-2 bg-green-200 px-2 py-1 text-green-700 text-xs font-medium rounded-full inline-block whitespace-nowrap text-center">
                                            HTML
                                        </p>
                                    </div>
                                    <div class="flex gap-3 my-2 px-3 items-center">
                                        <img src="{{ asset('assets/images/profile/default-profile2.jpg') }}"
                                            class="w-10 h-10 rounded-full" alt="">
                                        <div class="flex flex-col">
                                            <h1 class="text-base">
                                                Akbar
                                            </h1>
                                            <p class="text-xs">23 Juli 2024</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- card -->
        <div>
            <div class="card h-full shadow">
                <div class="border-b border-gray-300 px-5 py-4 flex items-center w-full justify-between">
                    <!-- title -->
                    <div>
                        <h4 class="font-semibold text-base">Portfolio Edutorium</h4>
                    </div>
                    <div>
                        <!-- button -->
                        <div class="dropdown leading-4">
                            {{-- <button
                                class="btn btn-sm gap-x-2 bg-white text-gray-800 border-gray-300 border disabled:opacity-50 disabled:pointer-events-none hover:text-white hover:bg-gray-700 hover:border-gray-700 active:bg-gray-700 active:border-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-300"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Buat Portfolio
                            </button> --}}
                            <!-- list -->
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    <!-- cards -->
                    <div class="relative max-h-96 overflow-y-auto p-4" data-simplebar="">
                        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4">
                            @foreach (range(1, 10) as $index)
                                <div
                                    class="bg-white shadow-md rounded-md overflow-hidden flex flex-col hover:scale-105 hover:shadow-lg transition-all ease-in-out">
                                    <div class="block relative">
                                        <img src="{{ asset('assets/images/blog/blog-img-1.jpg') }}" alt="">
                                        <p
                                            class="absolute top-2 right-2 bg-green-200 px-2 py-1 text-green-700 text-xs font-medium rounded-full inline-block whitespace-nowrap text-center">
                                            HTML
                                        </p>
                                    </div>
                                    <div class="flex gap-3 my-2 px-3 items-center">
                                        <img src="{{ asset('assets/images/profile/default-profile2.jpg') }}"
                                            class="w-10 h-10 rounded-full" alt="">
                                        <div class="flex flex-col">
                                            <h1 class="text-base">
                                                Akbar
                                            </h1>
                                            <p class="text-xs">23 Juli 2024</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('liveToastBtn').addEventListener('click', function() {
            const toastContainer = document.getElementById('toastContainer');
            toastContainer.classList.remove('translate-y-[-100%]', 'opacity-0');
            toastContainer.classList.add('translate-y-0', 'opacity-100');
        });

        function hideToast() {
            const toastContainer = document.getElementById('toastContainer');
            toastContainer.classList.remove('translate-y-0', 'opacity-100');
            toastContainer.classList.add('translate-y-[-100%]', 'opacity-0');
        }
    </script>
@endpush
