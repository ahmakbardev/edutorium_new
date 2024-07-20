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
        <a href="{{ route('user.bootcamp.modul.modul') }}"
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
                    <table id="progressTable" class="text-left w-full whitespace-nowrap">
                        <thead class="text-gray-700 sticky top-0">
                            <tr>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3 cursor-default">Nama</th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3 cursor-default">Sekolah</th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3 cursor-default">Modul</th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3 cursor-default">
                                    <p class="w-fit" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Nilai Quiz">Quiz</p>
                                </th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3 cursor-default">
                                    <p class="w-fit" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Nilai Post Test">Post Test</p>
                                </th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3 cursor-default">Terakhir Dikerjakan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($progress as $item)
                                <tr class="hover:bg-slate-100 transition-all ease-in-out cursor-pointer"
                                    data-name="{{ $item->user_name }}" data-sekolah="{{ $item->sekolah }}"
                                    data-module="{{ $item->module_name }}" data-quiz="{{ $item->quiz }}"
                                    data-livecode="{{ $item->livecode }}"
                                    data-updated="{{ \Carbon\Carbon::parse($item->updated_at)->format('d F Y H:i') }}">
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        {{ $item->user_name }}</td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        {{ $item->sekolah }}</td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        {{ $item->module_name }}</td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        {{ $item->quiz }}</td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        @if ($item->livecode)
                                            <i data-feather="check"></i>
                                        @else
                                            {{-- Uncomment if you want to use progress bar
                                            <div class="flex items-center gap-2">
                                                <div>{{ $item->post_test_score }}%</div>
                                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                                    <div class="bg-indigo-600 h-1.5 rounded-full" style="width: {{ $item->post_test_score }}%"></div>
                                                </div>
                                            </div> --}}
                                        @endif
                                    </td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        {{ \Carbon\Carbon::parse($item->updated_at)->format('d F Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal -->
            <div id="progressModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full modal-transition">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Progress Detail</h3>
                            <div class="mt-2">
                                <p><strong>Nama:</strong> <span id="modalName"></span></p>
                                <p><strong>Sekolah:</strong> <span id="modalSekolah"></span></p>
                                <p><strong>Modul:</strong> <span id="modalModule"></span></p>
                                <p><strong>Quiz:</strong> <span id="modalQuiz"></span></p>
                                <p><strong>Livecode:</strong> <span id="modalLivecode"></span></p>
                                <p><strong>Terakhir Dikerjakan:</strong> <span id="modalUpdated"></span></p>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 sm:ml-3 sm:w-auto sm:text-sm"
                                id="closeModal">Close</button>
                        </div>
                    </div>
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
                        class="w-4/5 h-fit {{ $isEmpty ? 'bg-slate-400' : 'border-primary-400' }} aspect-square rounded-full relative mx-auto flex justify-center items-center">
                        <img src="{{ Auth::user()->pic ? asset('storage/' . Auth::user()->pic) : asset('assets/images/profile/default-profile2.jpg') }}"
                            class="rounded-full border-[8px] w-full {{ $isEmpty ? 'border-slate-400' : 'border-primary-400' }} hover:border-[10px] transition-all ease-in-out"
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
                        @if ($latestProgress)
                            <div class="flex flex-col py-1">
                                <h4 class="label text-base">Progres Terakhir:</h4>
                                <h1 class="text-lg font-semibold">{{ $latestProgress->module_name }}</h1>
                            </div>
                        @else
                            <div class="flex flex-col py-1">
                                <h4 class="label text-base">Progres Terakhir:</h4>
                                <h1 class="text-lg font-semibold">Belum ada progres</h1>
                            </div>
                        @endif
                    </div>
                </div>
                @if ($latestProgress)
                    <div class="grid grid-cols-3 py-4">
                        <!-- content -->
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="w-6 h-6 text-green-500 mx-auto" data-feather="bookmark"></i>
                            </div>
                            <p class="text-gray-600">Progress Modul</p>
                            <span
                                class="text-2xl font-bold text-gray-800">{{ rtrim(rtrim(number_format($progressPercentage, 2), '0'), '.') }}%</span>
                            <span
                                class="bg-green-200 w-fit mx-auto px-3 py-1 text-green-700 text-xs font-medium rounded-full block whitespace-nowrap text-center">{{ $latestProgress->module_name }}</span>
                        </div>
                        <!-- content -->
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="w-6 h-6 text-green-500 mx-auto" data-feather="book"></i>
                            </div>

                            <p class="text-gray-600">Progress Quiz</p>
                            <span class="text-2xl font-bold text-gray-800">{{ $latestProgress->quiz ?? '0' }}%</span>
                            <span
                                class="bg-yellow-200 w-fit mx-auto px-3 py-1 text-yellow-700 text-xs font-medium rounded-full block whitespace-nowrap text-center">{{ $latestProgress->module_name }}</span>
                        </div>
                        <!-- content -->
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="w-6 h-6 text-green-500 mx-auto" data-feather="code"></i>
                            </div>
                            <p class="text-gray-600">Progress Coding</p>
                            <span
                                class="text-2xl font-bold text-gray-800">{{ $latestProgress->livecode ? 'Selesai' : '0%' }}</span>
                            <span
                                class="bg-red-200 w-fit mx-auto px-3 py-1 text-red-700 text-xs font-medium rounded-full block whitespace-nowrap text-center">{{ $latestProgress->module_name }}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
    <div class="mx-6 grid grid-cols-1 grid-rows-1 mt-5 grid-flow-row-dense gap-6">
        <div class="">
            <div class="card h-full shadow">
                <div class="border-b border-gray-300 px-5 py-4">
                    <h4 class="text-base">Histori Pembelajaran</h4>
                </div>

                <div class="relative overflow-x-auto overflow-y-auto max-h-[400px]" data-simplebar="">
                    <table id="historyTable" class="text-left w-full whitespace-nowrap">
                        <thead class="text-gray-700 sticky top-0">
                            <tr>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3 cursor-default">Modul</th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3 cursor-default">Materi</th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3 cursor-default">Quiz</th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3 cursor-default">Post Test</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $item)
                                @php
                                    $materiArray = json_decode($item->materi, true);
                                    $materi = isset($materiArray[1])
                                        ? $materiArray[1]
                                        : (isset($materiArray[0])
                                            ? $materiArray[0]
                                            : 'N/A');
                                @endphp
                                <tr class="hover:bg-slate-100 transition-all ease-in-out cursor-pointer"
                                    data-module="{{ $item->module_name }}" data-materi="{{ $materi }}"
                                    data-quiz="{{ $item->quiz }}" data-posttest="{{ $item->livecode }}"
                                    data-updated="{{ \Carbon\Carbon::parse($item->updated_at)->format('d F Y H:i') }}">
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        {{ $item->module_name }}</td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        {{ $materi }}</td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        <span
                                            class="bg-yellow-200 px-2 py-1 text-yellow-700 text-sm font-medium rounded-full inline-block whitespace-nowrap text-center">{{ $item->quiz }}</span>
                                    </td>
                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                        @if ($item->livecode)
                                            <i data-feather="check"></i>
                                        @else
                                            {{-- Uncomment if you want to use progress bar --}}
                                            {{-- <div class="flex items-center gap-2">
                                                <div>{{ $item->post_test_score }}%</div>
                                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                                    <div class="bg-indigo-600 h-1.5 rounded-full" style="width: {{ $item->post_test_score }}%"></div>
                                                </div>
                                            </div> --}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal for History -->
            <div id="historyModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full modal-transition">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Progress Detail</h3>
                            <div class="mt-2">
                                <p><strong>Modul:</strong> <span id="historyModalModule"></span></p>
                                <p><strong>Materi:</strong> <span id="historyModalMateri"></span></p>
                                <p><strong>Quiz:</strong> <span id="historyModalQuiz"></span></p>
                                <p><strong>Post Test:</strong> <span id="historyModalPostTest"></span></p>
                                <p><strong>Terakhir Dikerjakan:</strong> <span id="historyModalUpdated"></span></p>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 sm:ml-3 sm:w-auto sm:text-sm"
                                id="historyContinueLearning">Lanjutkan Belajar</button>
                            <button type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm"
                                id="historyCloseModal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="mx-6 my-10 grid grid-cols-1 lg:grid-cols-2 grid-rows-1 grid-flow-row-dense gap-6">
        <div>
            <div class="card h-full shadow">
                <div class="border-b border-gray-300 px-5 py-4 flex items-center w-full justify-between">
                    <div>
                        <h4 class="font-semibold text-base">Portfolioku</h4>
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    <div class="relative max-h-96 overflow-y-auto p-4" data-simplebar="">
                        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4">
                            @foreach ($userLivecodes as $livecode)
                                @php
                                    $data = json_decode($livecode->livecode, true);
                                @endphp
                                <div class="card bg-white shadow-md rounded-md overflow-hidden flex flex-col hover:scale-105 hover:shadow-lg transition-all ease-in-out"
                                    data-html="{{ $data['html'] }}" data-css="{{ $data['css'] }}"
                                    data-js="{{ $data['js'] }}" data-links="{{ $data['links'] }}"
                                    data-scripts="{{ $data['scripts'] }}">
                                    <div class="block relative">
                                        <img src="{{ asset('storage/' . $data['screenshot']) }}"
                                            class="max-h-32 object-cover w-full" alt="">
                                        <p
                                            class="absolute top-2 right-2 bg-green-200 px-2 py-1 text-green-700 text-xs font-medium rounded-full inline-block whitespace-nowrap text-center">
                                            {{ $livecode->module_name }}
                                        </p>
                                    </div>
                                    <div class="flex gap-3 my-2 px-3 items-center">
                                        <img src="{{ Auth::user()->pic ? asset('storage/' . Auth::user()->pic) : asset('assets/images/profile/default-profile2.jpg') }}"
                                            class="w-10 h-10 rounded-full" alt="">
                                        <div class="flex flex-col">
                                            <h1 class="text-base">{{ Auth::user()->name }}</h1>
                                            <p class="text-xs">
                                                {{ \Carbon\Carbon::parse($livecode->created_at)->format('d F Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- section all portfolios --}}
        <div>
            <div class="card h-full shadow">
                <div class="border-b border-gray-300 px-5 py-4 flex items-center w-full justify-between">
                    <div>
                        <h4 class="font-semibold text-base">Portfolio Edutorium</h4>
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    <div class="relative max-h-96 overflow-y-auto p-4" data-simplebar="">
                        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4">
                            @foreach ($allLivecodes as $livecode)
                                @php
                                    $data = json_decode($livecode->livecode, true);
                                @endphp
                                <div class="card bg-white shadow-md rounded-md overflow-hidden flex flex-col hover:scale-105 hover:shadow-lg transition-all ease-in-out"
                                    data-html="{{ $data['html'] }}" data-css="{{ $data['css'] }}"
                                    data-js="{{ $data['js'] }}" data-links="{{ $data['links'] }}"
                                    data-scripts="{{ $data['scripts'] }}">
                                    <div class="block relative">
                                        <img src="{{ asset('storage/' . $data['screenshot']) }}"
                                            class="max-h-32 object-cover w-full" alt="">
                                        <p
                                            class="absolute top-2 right-2 bg-green-200 px-2 py-1 text-green-700 text-xs font-medium rounded-full inline-block whitespace-nowrap text-center">
                                            {{ $livecode->module_name }}
                                        </p>
                                    </div>
                                    <div class="flex gap-3 my-2 px-3 items-center">
                                        <img src="{{ Auth::user()->pic ? asset('storage/' . Auth::user()->pic) : asset('assets/images/profile/default-profile2.jpg') }}"
                                            class="w-10 h-10 rounded-full" alt="">
                                        <div class="flex flex-col">
                                            <h1 class="text-base">{{ Auth::user()->name }}</h1>
                                            <p class="text-xs">
                                                {{ \Carbon\Carbon::parse($livecode->created_at)->format('d F Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal HTML -->
        <div id="livecodeModal"
            class="hidden fixed z-10 inset-0 overflow-y-auto transition-opacity ease-in-out duration-300">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity ease-in-out duration-300" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75 transition-all ease-in-out duration-300"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div id="livecodeModalContent"
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all ease-in-out duration-300 sm:my-8 sm:align-middle sm:max-w-screen-xl sm:w-screen opacity-0 translate-y-4 blur-sm h-fit">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 flex h-full">
                        <div class="sm:flex sm:items-start w-full h-full">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full h-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Livecode Preview
                                </h3>
                                <div class="mt-2 w-full h-[80vh]">
                                    <iframe id="livecodeIframe" class="w-full h-full bg-gray-100 rounded-md"
                                        src=""></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
                            id="close-modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                feather.replace();

                // Event listener untuk setiap card
                document.querySelectorAll('.card[data-html]').forEach(card => {
                    card.addEventListener('click', () => {
                        const htmlContent = card.getAttribute('data-html');
                        const cssContent = card.getAttribute('data-css');
                        const jsContent = card.getAttribute('data-js');
                        const links = card.getAttribute('data-links');
                        const scripts = card.getAttribute('data-scripts');

                        const iframe = document.getElementById('livecodeIframe');
                        const previewDoc = iframe.contentDocument || iframe.contentWindow.document;

                        previewDoc.open();
                        previewDoc.write(`
                <html>
                <head>
                    ${links}
                    <style>${cssContent}</style>
                </head>
                <body>
                    ${htmlContent}
                </body>
                </html>
            `);
                        previewDoc.close();

                        // Menambahkan CDN yang digunakan
                        if (jsContent.includes('gsap')) {
                            const gsapScript = previewDoc.createElement('script');
                            gsapScript.src =
                                "https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js";
                            gsapScript.onload = () => {
                                const userScript = previewDoc.createElement('script');
                                userScript.type = 'text/javascript';
                                userScript.text = jsContent;
                                previewDoc.body.appendChild(userScript);
                            };
                            previewDoc.body.appendChild(gsapScript);
                        }
                        if (jsContent.includes('three')) {
                            const threeScript = previewDoc.createElement('script');
                            threeScript.src =
                                "https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js";
                            threeScript.onload = () => {
                                const userScript = previewDoc.createElement('script');
                                userScript.type = 'text/javascript';
                                userScript.text = jsContent;
                                previewDoc.body.appendChild(userScript);
                            };
                            previewDoc.body.appendChild(threeScript);
                        }
                        if (jsContent.includes('jquery')) {
                            const jqueryScript = previewDoc.createElement('script');
                            jqueryScript.src =
                                "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js";
                            jqueryScript.onload = () => {
                                const userScript = previewDoc.createElement('script');
                                userScript.type = 'text/javascript';
                                userScript.text = jsContent;
                                previewDoc.body.appendChild(userScript);
                            };
                            previewDoc.body.appendChild(jqueryScript);
                        }
                        // Tambahkan cek lainnya sesuai kebutuhan

                        // Tampilkan modal dengan animasi
                        const modal = document.getElementById('livecodeModal');
                        const modalContent = document.getElementById('livecodeModalContent');
                        modal.classList.remove('hidden');
                        setTimeout(() => {
                            modalContent.classList.remove('opacity-0', 'translate-y-4',
                                'blur-sm');
                            modalContent.classList.add('opacity-100', 'translate-y-0',
                                'blur-none');
                        }, 10); // delay for smooth transition
                    });
                });

                // Event listener untuk tombol tutup modal
                document.getElementById('close-modal').addEventListener('click', () => {
                    const modal = document.getElementById('livecodeModal');
                    const modalContent = document.getElementById('livecodeModalContent');
                    modalContent.classList.add('opacity-0', 'translate-y-4', 'blur-sm');
                    modalContent.classList.remove('opacity-100', 'translate-y-0', 'blur-none');
                    setTimeout(() => {
                        modal.classList.add('hidden');
                    }, 300); // match the duration of the animation
                });
            });
        </script>

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
    <script>
        $(document).ready(function() {
            // Initialize DataTable with sorting, pagination, and filtering
            $('#progressTable').DataTable({
                "order": [
                    [5, "desc"]
                ],
                "pageLength": 10,
                "columnDefs": [{
                    "targets": [5],
                    "visible": true,
                    "searchable": true
                }]
            });

            // Event listener for table row click
            $('#progressTable tbody').on('click', 'tr', function() {
                const name = $(this).data('name');
                const sekolah = $(this).data('sekolah');
                const module = $(this).data('module');
                const quiz = $(this).data('quiz');
                const livecode = $(this).data('livecode');
                const updated = $(this).data('updated');

                $('#modalName').text(name);
                $('#modalSekolah').text(sekolah);
                $('#modalModule').text(module);
                $('#modalQuiz').text(quiz);
                $('#modalLivecode').text(livecode ? 'Selesai' : 'Belum Selesai');
                $('#modalUpdated').text(updated);

                $('#progressModal').removeClass('hidden');
                setTimeout(() => {
                    $('#progressModal .modal-transition').addClass('show');
                }, 10);
            });

            // Event listener for close button in modal
            $('#closeModal').on('click', function() {
                $('#progressModal .modal-transition').removeClass('show');
                setTimeout(() => {
                    $('#progressModal').addClass('hidden');
                }, 300); // match the duration of the animation
            });
        });

        $(document).ready(function() {
            // Initialize DataTable with sorting, pagination, and filtering
            $('#historyTable').DataTable({
                "order": [
                    [3, "desc"]
                ],
                "pageLength": 10,
                "columnDefs": [{
                    "targets": [3],
                    "visible": true,
                    "searchable": true
                }],
            });

            // Event listener for table row click
            $('#historyTable tbody').on('click', 'tr', function() {
                const module = $(this).data('module');
                const materi = $(this).data('materi');
                const quiz = $(this).data('quiz');
                const posttest = $(this).data('posttest');
                const updated = $(this).data('updated');

                $('#historyModalModule').text(module);
                $('#historyModalMateri').text(materi);
                $('#historyModalQuiz').text(quiz);
                $('#historyModalPostTest').text(posttest ? 'Selesai' : 'Belum Selesai');
                $('#historyModalUpdated').text(updated);

                const continueLearningButton = $('#historyContinueLearning');
                const urlContinueLearning = posttest && quiz ?
                    `/user/bootcamp/modul/${module}/Apa itu HTML` :
                    `/user/bootcamp/modul/${module}/${materi}`;
                continueLearningButton.text(posttest && quiz ? 'Pelajari Materi Kembali' :
                    'Lanjutkan Belajar');
                continueLearningButton.data('url', urlContinueLearning);

                $('#historyModal').removeClass('hidden');
                setTimeout(() => {
                    $('#historyModal .modal-transition').addClass('show');
                }, 10);
            });

            // Event listener for close button in modal
            $('#historyCloseModal').on('click', function() {
                $('#historyModal .modal-transition').removeClass('show');
                setTimeout(() => {
                    $('#historyModal').addClass('hidden');
                }, 300); // match the duration of the animation
            });

            // Event listener for continue learning button
            $('#historyContinueLearning').on('click', function() {
                const url = $(this).data('url');
                window.location.href = url;
            });
        });
    </script>
@endpush
