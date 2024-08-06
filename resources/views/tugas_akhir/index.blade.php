@extends('user.layouts.layout')

@section('content')
    <div class="mx-6 my-10 grid grid-cols-1 lg:grid-cols-2 grid-rows-1 grid-flow-row-dense gap-6">
        <div class="col-span-2">
            <div class="card h-full shadow">
                <div class="border-b border-gray-300 px-5 py-4 flex items-center w-full justify-between">
                    <!-- title -->
                    <div>
                        <h4 class="font-semibold text-2xl">Tugas Akhir</h4>
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    <!-- cards -->
                    <div class="relative max-h-[768px] overflow-y-auto p-4" data-simplebar="">
                        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
                            @foreach ($tugasAkhirs as $tugasAkhir)
                                <div class="card bg-white shadow-md rounded-md overflow-hidden flex flex-col hover:scale-105 hover:shadow-lg transition-all ease-in-out cursor-pointer"
                                    data-id="{{ $tugasAkhir->id }}" data-name="{{ $tugasAkhir->nama }}"
                                    data-description="{!! $tugasAkhir->deskripsi !!}" data-deadline="{{ $tugasAkhir->deadline }}"
                                    data-criteria="{{ $tugasAkhir->kriteria_penilaian }}" data-deskripsi-pdf="{{ $tugasAkhir->deskripsi_pdf }}">
                                    <div class="block relative">
                                        <img src="{{ asset('assets/images/blog/blog-img-1.jpg') }}" alt="">
                                        <p
                                            class="absolute top-2 right-2 bg-green-200 px-2 py-1 text-green-700 text-xs font-medium rounded-full inline-block whitespace-nowrap text-center">
                                            {{ $tugasAkhir->nama }}
                                        </p>
                                    </div>
                                    <div class="flex gap-3 my-2 px-3 items-center">
                                        <img src="{{ asset('assets/images/profile/default-profile2.jpg') }}"
                                            class="w-10 h-10 rounded-full" alt="">
                                        <div class="flex flex-col">
                                            <h1 class="text-base">{{ Auth::user()->name }}</h1>
                                            <p class="text-xs">
                                                {{ \Carbon\Carbon::parse($tugasAkhir->created_at)->format('d F Y') }}</p>
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

    <!-- Modal HTML -->
    <div id="tugasAkhirModal" class="hidden fixed z-10 inset-0 overflow-y-auto transition-opacity ease-in-out duration-300">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity ease-in-out duration-300" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75 transition-all ease-in-out duration-300"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div id="tugasAkhirModalContent"
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all ease-in-out duration-300 sm:my-8 sm:align-middle md:max-w-2xl sm:w-screen opacity-0 translate-y-4 blur-sm h-fit">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Kumpulkan Tugas Akhir
                            </h3>
                            <div class="mt-2" id="modal-content">
                                <!-- Form akan disini -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            feather.replace();

            // Event listener untuk setiap card
            document.querySelectorAll('.card[data-id]').forEach(card => {
                card.addEventListener('click', () => {
                    const id = card.getAttribute('data-id');
                    const name = card.getAttribute('data-name');
                    const description = card.getAttribute('data-description');
                    const deadline = card.getAttribute('data-deadline');
                    let criteria = card.getAttribute('data-criteria');
                    const deskripsi_pdf = card.getAttribute('data-deskripsi-pdf');

                    const assetUrl = '{{ asset('storage') }}';

                    const tugasAkhirs = @json($tugasAkhirs->keyBy('id'));
                    const submission = tugasAkhirs[id].submission;
                    const submissionFiles = submission ? tugasAkhirs[id].submission_files : [];

                    try {
                        criteria = JSON.parse(criteria);
                        if (!Array.isArray(criteria)) {
                            criteria = [];
                        }
                    } catch (error) {
                        criteria = [];
                    }

                    const modal = document.getElementById('tugasAkhirModal');
                    const modalContent = document.getElementById('tugasAkhirModalContent');
                    modal.classList.remove('hidden');
                    setTimeout(() => {
                        modalContent.classList.remove('opacity-0', 'translate-y-4',
                            'blur-sm');
                        modalContent.classList.add('opacity-100', 'translate-y-0',
                            'blur-none');
                    }, 10);

                    let filesHtml = '';
                    if (submissionFiles.length) {
                        submissionFiles.forEach(file => {
                            filesHtml += `
                                <div class="file-item mt-1 flex items-center justify-between rounded-md border-gray-300 shadow-sm p-2">
                                    <a href="{{ asset('storage/') }}/${file.file_path}" target="_blank" class="text-blue-500 hover:underline">${file.file_path.split('/').pop()}</a>
                                    <button type="button" class="delete-file-button text-red-500 ml-2" data-file-id="${file.id}">Hapus</button>
                                </div>
                            `;
                        });
                    } else {
                        filesHtml =
                            '<input type="file" id="files" name="files[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">';
                    }

                    document.getElementById('modal-content').innerHTML = `
                        <p><strong>Deskripsi:</strong></p>
                        <div>${description}</div>
                        <p class="mt-2"><strong class="inline">Deadline:</strong> <span class="bg-gray-200 px-2 py-1 text-gray-700 text-sm font-medium rounded-md inline whitespace-nowrap text-center w-fit">${deadline}</span></p>
                        <div class="mt-3 flex gap-2 items-center">
                            <strong>Kriteria Penilaian:</strong>
                            <div class="flex gap-2 inline flex-wrap">
                                ${criteria.map(criterion => `<span class="bg-blue-200 px-2 py-1 text-blue-700 text-sm font-medium rounded-md inline whitespace-nowrap text-center hover:scale-105 transition-all ease-in-out cursor-default">${criterion}</span>`).join('')}
                            </div>
                        </div>
                        <div class="mt-4 w-full">
                            <a href="${assetUrl}/${deskripsi_pdf}" target="_blank" class="bg-green-500 hover:bg-green-700 text-white py-2 my-4 flex justify-center transition-all esae-in-out text-center w-full rounded-md">Buka Deskripsi Lebih Lengkap</a>
                        </div>
                        <form action="{{ route('user.tugas-akhir.store') }}" method="POST" enctype="multipart/form-data" class="py-4">
                            @csrf
                            <input type="hidden" id="tugas_akhir_id" name="tugas_akhir_id" value="${id}">
                            <div class="mb-4">
                                <label for="additional_info" class="block text-sm font-medium text-gray-700">Informasi Tambahan</label>
                                <textarea id="additional_info" name="additional_info" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">${submission ? submission.additional_info : ''}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="github_url" class="block text-sm font-medium text-gray-700">URL GitHub (Opsional)</label>
                                <input type="url" id="github_url" name="github_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="${submission ? submission.github_url : ''}">
                            </div>
                            <div class="mb-4">
                                <label for="web_url" class="block text-sm font-medium text-gray-700">URL Web (Opsional)</label>
                                <input type="url" id="web_url" name="web_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="${submission ? submission.web_url : ''}">
                            </div>
                            <div class="mb-4">
                                <label for="files" class="block text-sm font-medium text-gray-700">Upload File (PDF, max 3MB per file)</label>
                                <div id="file-uploads">
                                    ${filesHtml}
                                </div>
                                <button type="button" id="add-file-upload" class="mt-2 px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md">Tambah File</button>
                            </div>
                            <div class="flex justify-end">
                                <button type="button" id="close-modal" class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md mr-2">Batal</button>
                                <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md">${submission ? 'Update' : 'Kumpulkan'}</button>
                            </div>
                        </form>
                    `;


                    document.querySelectorAll('.delete-file-button').forEach(button => {
                        button.addEventListener('click', function() {
                            const fileId = this.getAttribute('data-file-id');
                            $.ajax({
                                url: `{{ route('user.tugas-akhir.delete-file', ['fileId' => 'FILE_ID']) }}`
                                    .replace('FILE_ID', fileId),
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    if (response.success) {
                                        button.parentElement.remove();
                                        showToast(response.message,
                                            'success');
                                    } else {
                                        showToast(response.message,
                                            'error');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    showToast(
                                        'An error occurred while deleting the file.',
                                        'error');
                                    console.error('Error:', xhr
                                        .responseText);
                                }
                            });
                        });
                    });


                    document.getElementById('add-file-upload').addEventListener('click', () => {
                        const fileUploadsDiv = document.getElementById('file-uploads');
                        const newFileInput = document.createElement('input');
                        newFileInput.type = 'file';
                        newFileInput.name = 'files[]';
                        newFileInput.classList.add('mt-1', 'block', 'w-full', 'rounded-md',
                            'border-gray-300', 'shadow-sm');
                        fileUploadsDiv.appendChild(newFileInput);
                    });

                    document.getElementById('close-modal').addEventListener('click', () => {
                        modalContent.classList.add('opacity-0', 'translate-y-4', 'blur-sm');
                        modalContent.classList.remove('opacity-100', 'translate-y-0',
                            'blur-none');
                        setTimeout(() => {
                            modal.classList.add('hidden');
                        }, 300);
                    });
                });
            });
        });
    </script>
@endpush
