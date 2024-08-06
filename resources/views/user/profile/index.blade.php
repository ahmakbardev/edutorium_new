@extends('user.layouts.layout')

@section('content')
    <div class="p-6">
        <div class="flex items-center mb-4 border-b border-gray-300 pb-4">
            <!-- title -->
            <h1 class="inline-block text-xl font-semibold leading-6">Overview</h1>
        </div>
        <div class="block">
            <div class="flex items-center p-5 rounded-t-md shadow bg-cover bg-no-repeat pt-28 bg-center"
                style="background-image: url({{ asset('assets/images/background/edutorium-mini.png') }})"></div>
            <div class="bg-white rounded-b-md shadow mb-6">
                <div class="flex items-center justify-between pt-4 pb-6 px-4">
                    <div class="flex items-center">
                        <!-- avatar -->
                        @php
                            $username = strtolower(str_replace(' ', '-', Auth::user()->name));
                        @endphp
                        <div class="w-24 h-24 mr-2 relative flex justify-end items-end -mt-10">
                            <img src="{{ Auth::user()->pic ? asset('storage/' . Auth::user()->pic) : asset('assets/images/profile/default-profile2.jpg') }}"
                                class="rounded-full border-4 border-white" alt="{{ $username }}">

                            <button class="absolute top-0 right-0 mr-2 cursor-default" data-bs-toggle="tooltip"
                                data-placement="top"
                                title="{{ $isEmpty ? 'Akun kamu belum verified!' : 'Akun kamu sudah verified!' }}"
                                data-original-title="Verified" data-bs-original-title="">
                                <img src="{{ $isEmpty ? asset('assets/images/svg/unchecked-mark.svg') : asset('assets/images/svg/checked-mark.svg') }}"
                                    height="30" width="30" alt="">
                            </button>
                        </div>
                        <!-- text -->
                        <div class="leading-4">
                            <h2 class="mb-2 text-lg whitespace-nowrap">
                                {{ Auth::user()->name }}
                                <a href="#!" class="text-decoration-none" data-bs-toggle="tooltip" data-placement="top"
                                    title="" data-original-title="Beginner" data-bs-original-title=""></a>
                            </h2>
                            <p class="mb-0 text-gray-500">
                                <span>@</span>{{ $username }}
                            </p>

                        </div>
                    </div>
                    <div>
                        <a href="{{ route('user.profile.edit') }}"
                            class="btn bg-indigo-600 text-white border-indigo-600 hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 md:visible invisible">
                            Edit Profile
                        </a>
                    </div>
                </div>
                <!-- nav -->
                {{-- <div class=" ">
                    <!-- list -->
                    <ul class="flex flex-no-wrap overflow-auto text-center text-gray-500 border-gray-300 border-t">
                        <li class="mr-2">
                            <a href="#"
                                class="block p-4 text-indigo-600 border-t-2 font-semibold border-indigo-600 active"
                                aria-current="page">Overview</a>
                        </li>
                        <li class="mr-2">
                            <a href="#"
                                class="inline-block p-4 text-gray-800 font-semibold border-t-2 border-transparent hover:text-indigo-600 hover:border-indigo-600">Profile</a>
                        </li>
                        <li class="mr-2">
                            <a href="#"
                                class="inline-block p-4 text-gray-800 font-semibold border-t-2 border-transparent hover:text-indigo-600 hover:border-indigo-600">Files</a>
                        </li>
                        <li class="mr-2">
                            <a href="#"
                                class="inline-block p-4 text-gray-800 font-semibold border-t-2 border-transparent hover:text-indigo-600 hover:border-indigo-600">Teams</a>
                        </li>
                        <li class="mr-2">
                            <a href="#"
                                class="inline-block p-4 text-gray-800 font-semibold border-t-2 border-transparent hover:text-indigo-600 hover:border-indigo-600">Followers</a>
                        </li>
                        <li class="mr-2">
                            <a href="#"
                                class="inline-block p-4 text-gray-800 font-semibold border-t-2 border-transparent hover:text-indigo-600 hover:border-indigo-600">Activity</a>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </div>
        <div class="mb-6 grid grid-cols-1 gap-x-6 gap-y-8 xl:grid-cols-2">
            <!-- card -->
            <div class="card shadow">
                <!-- card body -->
                <div class="card-body">
                    <!-- card title -->
                    <!-- text -->
                    <div class="flex flex-row justify-between">
                        <div class="flex-1">
                            <h5 class="uppercase tracking-widest text-sm font-semibold">Bio</h5>
                            <p class="mt-2 mb-6">
                                {{ Auth::user()->bio ? Auth::user()->bio : 'Bio belum diisi.' }}
                            </p>
                        </div>
                    </div>

                    <!-- row -->
                    <div class="flex flex-row justify-between">
                        <div class="flex-1">
                            <h5 class="uppercase tracking-widest text-sm font-semibold">Email</h5>
                            <p class="mb-0">{{ Auth::user()->email ? Auth::user()->email : 'Email belum diisi.' }}</p>
                        </div>
                        <div class="flex-1">
                            <div class="mb-5">
                                <!-- text -->
                                <h5 class="uppercase tracking-widest text-sm font-semibold">Sekolah</h5>
                                <p class="mb-0">
                                    {{ Auth::user()->sekolah ? Auth::user()->sekolah : 'Sekolah belum diisi.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row justify-between">
                        <!-- content -->
                        <div class="flex-1">
                            <h5 class="uppercase tracking-widest text-sm font-semibold">Nomor Telepon</h5>
                            <p class="mb-5">
                                {{ Auth::user()->phone ? Auth::user()->phone : 'Nomor Telepon belum diisi.' }}
                            </p>
                        </div>
                        <div class="flex-1">
                            <h5 class="uppercase tracking-widest text-sm font-semibold">Kelas</h5>
                            <p class="mb-0">{{ Auth::user()->kelas ? Auth::user()->kelas : 'Kelas belum diisi.' }}</p>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h5 class="uppercase tracking-widest text-sm font-semibold">Tanggal Lahir</h5>
                        <p class="mb-0">
                            {{ Auth::user()->tgl_lahir ? \Carbon\Carbon::parse(Auth::user()->tgl_lahir)->translatedFormat('d F Y') : 'Tanggal Lahir belum diisi.' }}
                        </p>
                    </div>
                </div>
            </div>
            <!-- card -->
            {{-- <div class="card shadow">
                <!-- card body -->
                <div class="card-body">
                    <!-- card title -->
                    <h4 class="mb-6">Projects Contributions</h4>
                    <div class="md:flex justify-between items-center mb-4">
                        <div class="flex items-center">
                            <div>
                                <div class="border p-3 rounded-md">
                                    <img src="{{ asset('assets/images/brand/slack-logo.svg') }}" alt=""
                                        class="w-5 h-5" />
                                </div>
                            </div>
                            <!-- text -->
                            <div class="ml-3">
                                <h5 class="text-gray-800">
                                    <a href="#">Slack Figma Design UI</a>
                                </h5>
                                <p>Project description and details about...</p>
                            </div>
                        </div>
                        <div class="flex items-center ms-10 ms-md-0 mt-3">
                            <!-- avatar group -->
                            <div class="-space-x-3 flex">
                                <img class="relative inline object-cover w-8 h-8 rounded-full border-white border-2"
                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Profile image" />
                                <img class="relative inline object-cover w-8 h-8 rounded-full border-white border-2"
                                    src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Profile image" />
                                <img class="relative inline object-cover w-8 h-8 border-2 rounded-full border-white"
                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Profile image" />
                            </div>
                            <div class="ml-3">
                                <!-- dropdown -->
                                <div class="dropstart leading-4">
                                    <button class="text-gray-600 p-2 hover:bg-gray-300 rounded-full transition-all"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i data-feather="more-vertical" class="w-4 h-4"></i>
                                    </button>
                                    <!-- list -->
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md:flex justify-between items-center mb-4">
                        <div class="flex items-center">
                            <div>
                                <!-- icon shape -->
                                <div class="border p-3 rounded-md">
                                    <img src="{{ asset('assets/images/brand/3dsmax-logo.svg') }}" alt=""
                                        class="w-5 h-5" />
                                </div>
                            </div>
                            <!-- text -->
                            <div class="ml-3">
                                <h5 class="text-gray-800">
                                    <a href="#">Design 3d Character</a>
                                </h5>
                                <p class="mb-0">Project description and details about...</p>
                            </div>
                        </div>

                        <div class="flex items-center ms-10 ms-md-0 mt-3">
                            <!-- avatar group -->
                            <div class="-space-x-3 flex">
                                <img class="relative inline object-cover w-8 h-8 rounded-full border-white border-2"
                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Profile image" />
                                <img class="relative inline object-cover w-8 h-8 rounded-full border-white border-2"
                                    src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Profile image" />
                                <img class="relative inline object-cover w-8 h-8 border-2 rounded-full border-white"
                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Profile image" />
                            </div>
                            <div class="ml-3">
                                <!-- dropdown -->
                                <div class="dropstart leading-4">
                                    <button class="text-gray-600 p-2 hover:bg-gray-300 rounded-full transition-all"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i data-feather="more-vertical" class="w-4 h-4"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md:flex justify-between items-center mb-4">
                        <div class="flex items-center">
                            <div>
                                <!-- icon shape -->
                                <div class="border p-3 rounded-md">
                                    <img src="{{ asset('assets/images/brand/github-logo.svg') }}" alt=""
                                        class="w-5 h-5" />
                                </div>
                            </div>
                            <!-- text -->
                            <div class="ml-3">
                                <h5 class="text-gray-800">
                                    <a href="#">Github Development</a>
                                </h5>
                                <p>Project description and details about...</p>
                            </div>
                        </div>
                        <div class="flex items-center ms-10 ms-md-0 mt-3">
                            <!-- avatar group -->
                            <div class="-space-x-3 flex">
                                <img class="relative inline object-cover w-8 h-8 rounded-full border-white border-2"
                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Profile image" />
                                <img class="relative inline object-cover w-8 h-8 rounded-full border-white border-2"
                                    src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Profile image" />
                                <img class="relative inline object-cover w-8 h-8 border-2 rounded-full border-white"
                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Profile image" />
                            </div>
                            <div class="ml-3">
                                <!-- dropdown -->
                                <div class="dropstart leading-4">
                                    <button class="text-gray-600 p-2 hover:bg-gray-300 rounded-full transition-all"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i data-feather="more-vertical" class="w-4 h-4"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md:flex justify-between items-center mb-4">
                        <div class="flex items-center">
                            <!-- icon shape -->
                            <div>
                                <div class="border p-3 rounded-md">
                                    <img src="{{ asset('assets/images/brand/dropbox-logo.svg') }}" alt=""
                                        class="w-5 h-5" />
                                </div>
                            </div>
                            <!-- text -->
                            <div class="ml-3">
                                <h5 class="text-gray-800">
                                    <a href="#">Dropbox Design System</a>
                                </h5>
                                <p>Project description and details about...</p>
                            </div>
                        </div>
                        <div class="flex items-center ms-10 ms-md-0 mt-3">
                            <!-- avatar group -->
                            <div class="-space-x-3 flex">
                                <img class="relative inline object-cover w-8 h-8 rounded-full border-white border-2"
                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Profile image" />
                                <img class="relative inline object-cover w-8 h-8 rounded-full border-white border-2"
                                    src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Profile image" />
                                <img class="relative inline object-cover w-8 h-8 border-2 rounded-full border-white"
                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Profile image" />
                            </div>
                            <div class="ml-3">
                                <!-- dropdown -->
                                <div class="dropstart leading-4">
                                    <button class="text-gray-600 p-2 hover:bg-gray-300 rounded-full transition-all"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i data-feather="more-vertical" class="w-4 h-4"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md:flex justify-between items-center">
                        <div class="flex items-center">
                            <!-- icon shape -->
                            <div>
                                <div class="border p-3 rounded-md bg-indigo-600">
                                    <img src="{{ asset('assets/images/brand/layers-logo.svg') }}" alt=""
                                        class="w-5 h-5" />
                                </div>
                            </div>
                            <!-- text -->
                            <div class="ml-3">
                                <h5 class="text-gray-800">
                                    <a href="#">Project Management</a>
                                </h5>
                                <p>Project description and details about...</p>
                            </div>
                        </div>
                        <div class="flex items-center ms-10 ms-md-0 mt-3">
                            <!-- avatar group -->
                            <div class="-space-x-3 flex">
                                <img class="relative inline object-cover w-8 h-8 rounded-full border-white border-2"
                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Profile image" />
                                <img class="relative inline object-cover w-8 h-8 rounded-full border-white border-2"
                                    src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="Profile image" />
                                <img class="relative inline object-cover w-8 h-8 border-2 rounded-full border-white"
                                    src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="Profile image" />
                            </div>
                            <div class="ml-3">
                                <!-- dropdown -->
                                <div class="dropstart leading-4">
                                    <button class="text-gray-600 p-2 hover:bg-gray-300 rounded-full transition-all"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i data-feather="more-vertical" class="w-4 h-4"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
