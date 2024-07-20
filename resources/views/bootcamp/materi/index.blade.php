@extends('user.layouts.layout')

@section('content')
    @php
        if (!function_exists('addTailwindClasses')) {
            function addTailwindClasses($content)
            {
                // Tambahkan class Tailwind ke elemen-elemen CKEditor
                $content = preg_replace('/<p>/', '<p class="mb-4 text-gray-700">', $content);
                $content = preg_replace('/<h1>/', '<h1 class="text-3xl font-bold mb-4">', $content);
                $content = preg_replace('/<h2>/', '<h2 class="text-2xl font-bold mb-3">', $content);
                $content = preg_replace('/<h3>/', '<h3 class="text-xl font-bold mb-2">', $content);
                $content = preg_replace('/<img/', '<img class="rounded-lg shadow-md mb-4"', $content);
                $content = preg_replace(
                    '/<figure class="media"/',
                    '<figure class="media rounded-lg overflow-hidden"',
                    $content,
                );
                $content = preg_replace(
                    '/<p class="mb-4 text-gray-700">&nbsp/',
                    '<p class="mb-4 text-gray-700 hidden">&nbsp',
                    $content,
                );
                // Tambahkan class lain sesuai kebutuhan
                return $content;
            }
        }

        if ($currentMateri) {
            $formattedContent = addTailwindClasses($currentMateri->materi);
        }
    @endphp

    <div class="mx-6 my-4 grid grid-cols-1 grid-rows-1 grid-flow-row-dense gap-6">
        <div>
            <div class="card h-full shadow">
                <div class="border-b border-gray-300 px-5 py-4 flex items-center w-full justify-between">
                    <!-- title -->
                    <div class="flex justify-between w-full">
                        <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                            <li class="inline-flex items-center">
                                <a class="flex items-center text-xs transition-all ease-in-out text-gray-500 hover:text-indigo-600 focus:outline-none focus:text-indigo-600"
                                    href="#">Home</a>
                                <svg class="flex-shrink-0 mx-2 overflow-visible h-4 w-4 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6" />
                                </svg>
                            </li>
                            <li class="inline-flex items-center">
                                <a class="flex items-center text-xs transition-all ease-in-out text-gray-500 hover:text-indigo-600 focus:outline-none focus:text-indigo-600"
                                    href="#">
                                    Library
                                    <svg class="flex-shrink-0 mx-2 overflow-visible h-4 w-4 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="m9 18 6-6-6-6" />
                                    </svg>
                                </a>
                            </li>
                            <li class="inline-flex items-center text-xs transition-all ease-in-out font-semibold text-gray-800 truncate"
                                aria-current="page">Data</li>
                        </ol>
                        <a href="{{ route('user.dashboard') }}"
                            class="py-2 px-4 rounded-lg bg-red-600 text-white border-red-600 transition-all ease-in-out group flex items-center hover:bg-red-800 hover:border-red-800 active:bg-red-800 active:border-red-800 focus:outline-none focus:ring-4 focus:ring-red-300">Kembali
                            ke Beranda</a>
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    <!-- cards -->
                    <div class="relative max-h-[700px] overflow-y-auto p-4" data-simplebar="">
                        <div class="grid grid-cols-1 max-w-2xl mx-auto">
                            {!! $formattedContent !!}
                        </div>
                    </div>
                </div>
                <div class="flex justify-between px-3 py-5">
                    <a href="{{ $prevMateri ? route('user.bootcamp.modul.materi', ['modul' => strtolower($module->name), 'materi' => strtolower(str_replace(' ', '-', $prevMateri->nama_materi))]) : '#' }}"
                        class="py-2 pr-4 pl-2 rounded-lg bg-indigo-600 text-white border-indigo-600 disabled:opacity-50 transition-all ease-in-out group {{ $prevMateri ? '' : 'disabled:pointer-events-none opacity-50' }} flex items-center hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                        <i class="w-6 h-6 text-white group-hover:-translate-x-1 transition-all ease-in-out"
                            data-feather="chevron-left"></i>
                        <p>
                            {{ $prevMateri ? $prevMateri->nama_materi : 'Materi Habis' }}
                        </p>
                    </a>
                    @if ($nextMateri)
                        <a href="{{ route('user.bootcamp.modul.materi', ['modul' => strtolower($module->name), 'materi' => strtolower(str_replace(' ', '-', $nextMateri->nama_materi))]) }}"
                            class="py-2 pl-4 pr-2 rounded-lg bg-indigo-600 text-white border-indigo-600 transition-all ease-in-out group flex items-center hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                            <p>
                                {{ $nextMateri->nama_materi }}
                            </p>
                            <i class="w-6 h-6 text-white group-hover:translate-x-1 transition-all ease-in-out"
                                data-feather="chevron-right"></i>
                        </a>
                    @else
                        @if ($quizExists && !$quizCompleted)
                            <a href="{{ route('user.quiz.show', ['module_id' => $module->id]) }}"
                                class="py-2 pl-4 pr-2 rounded-lg bg-green-600 text-white border-green-600 transition-all ease-in-out group flex items-center hover:bg-green-800 hover:border-green-800 active:bg-green-800 active:border-green-800 focus:outline-none focus:ring-4 focus:ring-green-300">
                                <p>
                                    Mulai Kuis
                                </p>
                                <i class="w-6 h-6 text-white group-hover:translate-x-1 transition-all ease-in-out"
                                    data-feather="chevron-right"></i>
                            </a>
                        @elseif ($quizCompleted && !$livecodeCompleted)
                            <a href="{{ route('user.livecoding.show', ['moduleId' => $module->id]) }}"
                                class="py-2 pl-4 pr-2 rounded-lg bg-blue-600 text-white border-blue-600 transition-all ease-in-out group flex items-center hover:bg-blue-800 hover:border-blue-800 active:bg-blue-800 active:border-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                                <p>
                                    Mulai Livecode
                                </p>
                                <i class="w-6 h-6 text-white group-hover:translate-x-1 transition-all ease-in-out"
                                    data-feather="chevron-right"></i>
                            </a>
                        @endif
                    @endif
                </div>


            </div>
        </div>
    </div>
@endsection
