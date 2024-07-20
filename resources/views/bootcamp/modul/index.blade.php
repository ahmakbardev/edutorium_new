@extends('user.layouts.layout')

@section('content')
    <div class="mx-6 my-10 grid grid-cols-1 grid-rows-1 grid-flow-row-dense gap-6">
        <div>
            <div class="card h-full shadow">
                <div class="border-b border-gray-300 px-5 py-4 flex items-center w-full justify-between">
                    <!-- title -->
                    <div>
                        <h4 class="font-semibold text-2xl">Modul Bootcamp</h4>
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
                                @if (!in_array($module->id, $displayedModules))
                                    @php
                                        $displayedModules[] = $module->id;
                                        $firstMateri = $materis->firstWhere('modul_id', $module->id);
                                        $prevModuleCompleted = true;
                                        $prevModuleId = $module->id - 1;
                                        $currentModuleCompleted = $userProgress
                                            ->where('module_id', $module->id)
                                            ->whereNotNull('quiz')
                                            ->whereNotNull('livecode')
                                            ->isNotEmpty();

                                        if ($prevModuleId > 0) {
                                            $prevModuleProgress = $userProgress
                                                ->where('module_id', $prevModuleId)
                                                ->first();
                                            $prevModuleCompleted =
                                                $prevModuleProgress &&
                                                $prevModuleProgress->quiz !== null &&
                                                $prevModuleProgress->livecode !== null;
                                        }

                                        $status = $currentModuleCompleted
                                            ? 'Done'
                                            : ($prevModuleCompleted
                                                ? 'Available'
                                                : 'Locked');
                                    @endphp
                                    @if ($firstMateri)
                                        @php
                                            $slug = strtolower(str_replace(' ', '-', $firstMateri->nama_materi));
                                        @endphp
                                        <a href="{{ $prevModuleCompleted ? route('user.bootcamp.modul.materi', ['modul' => $module->name, 'materi' => $slug]) : '#' }}"
                                            class="bg-white shadow-md rounded-md overflow-hidden flex flex-col {{ $prevModuleCompleted ? 'hover:scale-105 hover:shadow-lg transition-all ease-in-out' : 'opacity-50 cursor-not-allowed' }}">
                                            <div class="block relative">
                                                <img src="{{ $module->image ? asset('storage/' . $module->image) : asset('assets/images/blog/blog-img-1.jpg') }}"
                                                    class="h-40 max-h-40 w-full object-cover" alt="">
                                                <p
                                                    class="absolute top-2 right-2 {{ $status == 'Done' ? 'bg-blue-200 text-blue-700' : ($status == 'Available' ? 'bg-green-200 text-green-700' : 'bg-red-200 text-red-700') }} px-2 py-1 text-xs font-medium rounded-full inline-block whitespace-nowrap text-center">
                                                    {{ $status }}
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
