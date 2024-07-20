@extends('user.layouts.layout')

@section('content')
    <div class="mx-6 my-10 grid grid-cols-1 grid-rows-1 grid-flow-row-dense gap-6">
        <div>
            <div class="card h-full shadow">
                <div class="border-b border-gray-300 px-5 py-4 flex items-center w-full justify-between">
                    <!-- title -->
                    <div>
                        <h4 class="font-semibold text-2xl">Modul Livecoding</h4>
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    <!-- cards -->
                    <div class="relative max-h-[768px] overflow-y-auto p-4" data-simplebar="">
                        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-8 py-6">
                            @php
                                $displayedModules = [];
                            @endphp
                            @foreach ($modules as $module)
                                @php
                                    $hasLivecodeTutorials = DB::table('livecode_tutorials')
                                        ->where('module_id', $module->id)
                                        ->exists();

                                    $userProgress = $userProgresses->get($module->id);

                                    if ($userProgress) {
                                        $livecodeStatus = $userProgress->livecode
                                            ? 'Done'
                                            : ($module->all_materis_completed
                                                ? 'Available'
                                                : 'Incomplete');
                                    } else {
                                        $livecodeStatus = 'Start Your Module';
                                    }

                                    $cardClass =
                                        $livecodeStatus == 'Done' ||
                                        $livecodeStatus == 'Incomplete' ||
                                        $livecodeStatus == 'Start Your Module'
                                            ? 'opacity-50 cursor-not-allowed'
                                            : 'hover:scale-105 hover:shadow-lg transition-all ease-in-out';
                                @endphp
                                @if ($hasLivecodeTutorials && !in_array($module->id, $displayedModules))
                                    @php
                                        $displayedModules[] = $module->id;
                                        $firstMateri = $materis->firstWhere('modul_id', $module->id);

                                        $slug = strtolower(str_replace(' ', '-', $firstMateri->nama_materi));
                                    @endphp
                                    @if ($firstMateri)
                                        <a href="{{ $livecodeStatus == 'Available' ? route('user.livecoding.show', ['moduleId' => $module->id]) : '#' }}"
                                            class="bg-white shadow-md rounded-md overflow-hidden flex flex-col {{ $cardClass }}">
                                            <div class="block relative">
                                                <img src="{{ $module->image ? asset('storage/' . $module->image) : asset('assets/images/blog/blog-img-1.jpg') }}"
                                                    class="h-40 max-h-40 w-full object-cover" alt="">
                                                <p
                                                    class="absolute top-2 right-2 {{ $livecodeStatus == 'Done' ? 'bg-blue-200 text-blue-700' : ($livecodeStatus == 'Available' ? 'bg-green-200 text-green-700' : 'bg-yellow-200 text-yellow-700') }} px-2 py-1 text-xs font-medium rounded-full inline-block whitespace-nowrap text-center">
                                                    {{ $livecodeStatus }}
                                                </p>
                                            </div>
                                            <div class="flex gap-3 my-3 px-3 items-center">
                                                <div class="flex flex-col">
                                                    <h1 class="text-lg font-semibold">
                                                        {{ $module->name }}
                                                    </h1>
                                                    <p class="text-xs">
                                                        {{ \Carbon\Carbon::parse($module->created_at)->format('d F Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
