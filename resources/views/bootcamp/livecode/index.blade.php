<!-- resources/views/livecoding/index.blade.php -->
@extends('user.layouts.layout')

@section('content')
    <div class="mx-6 my-10 grid grid-cols-1 grid-rows-1 grid-flow-row-dense gap-6">
        <!-- Preview Area -->
        <div class="w-full min-h-[768px]">
            <iframe id="preview" class="w-full h-full relative bg-white  overflow-y-auto max-h-[768px] rounded-md "
                data-simplebar=""></iframe>
        </div>

        <!-- Button Controls -->
        <div id="control-buttons"
            class="flex justify-between mb-4 fixed bottom-[330px] left-0 right-0 px-6 transition-transform duration-300">
            <div class="flex gap-4">
                <button id="tailwind-btn"
                    class="p-2 ml-20 bg-blue-500 hover:bg-blue-400 rounded text-white transition-all ease-in-out"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Aktifkan Framework Tailwind"
                    type="button">Tailwind</button>
                <button id="bootstrap-btn"
                    class="p-2 bg-purple-500 hover:bg-purple-400 rounded text-white transition-all ease-in-out"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Aktifkan Framework Bootstrap"
                    type="button">Bootstrap</button>
            </div>
            <div class="flex gap-4">
                <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" role="button"
                    aria-controls="offcanvasExample"
                    class="p-2 bg-red-500 hover:bg-red-400 rounded text-white transition-all ease-in-out mr-2">Tutorial</button>
                <button id="toggle-livecode"
                    class="p-2 bg-gray-800 hover:bg-gray-700 rounded text-white transition-all ease-in-out mr-2">Hide
                    Koding</button>
                <button id="toggle-size"
                    class="p-2 bg-gray-800 hover:bg-gray-700 rounded text-white transition-all ease-in-out mr-2">Expand
                    Koding</button>
                <button id="submit-button"
                    class="p-2 bg-green-500 hover:bg-green-400 rounded text-white transition-all ease-in-out">Submit</button>
            </div>
        </div>


        <!-- Livecode Area -->
        <div id="livecode-container"
            class="fixed bottom-5 h-80 overflow-hidden left-5 right-5 rounded-md flex bg-gray-900 text-white transform transition-all duration-300">
            <!-- Sidebar -->
            <div class="w-16 bg-gray-900 text-white flex flex-col items-center py-4">
                <button id="html-tab"
                    class="mb-4 p-2 bg-gray-700 hover:bg-gray-600 rounded transform transition-transform duration-200 active-tab">
                    <i data-feather="code"></i>
                </button>
                <button id="css-tab"
                    class="mb-4 p-2 bg-gray-700 hover:bg-gray-600 rounded transform transition-transform duration-200">
                    <i data-feather="file-text"></i>
                </button>
                <button id="js-tab"
                    class="mb-4 p-2 bg-gray-700 hover:bg-gray-600 rounded transform transition-transform duration-200">
                    <i data-feather="terminal"></i>
                </button>
            </div>

            <!-- Editor Area -->
            <div class="flex-1 flex flex-col">
                <div class="bg-gray-800 text-white px-4 py-2 flex justify-between relative z-10">
                    <span id="active-tab" class="text-sm text-start"></span>
                    <h4 class="font-semibold text-lg">Preview</h4>
                </div>
                <div id="editor-container" class="flex-1 border-b border-gray-300 relative z-[2]">
                    <textarea id="html-editor" class="hidden h-full"></textarea>
                    <textarea id="css-editor" class="hidden h-full"></textarea>
                    <textarea id="js-editor" class="hidden h-full"></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Offcanvas Tutorial -->
    <div class="offcanvas -translate-x-full fixed top-0 start-0 border-r border-gray-300 transition-all duration-300 transform h-full invisible bg-white z-50 w-screen max-w-xl"
        tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="flex items-center p-4">
            <h5 class="text-lg" id="offcanvasExampleLabel">Tutorial</h5>
            <button type="button" class="btn-close"></button>
            <button type="button" data-bs-dismiss="offcanvas" aria-label="Close"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center ">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
        </div>
        <div class="p-4 h-[90%]">
            @foreach ($tutorials as $tutorial)
                <div class="mb-4 h-full flex flex-col justify-between">
                    <div class="flex flex-col gap-3">
                        <div class="flex flex-col border-b">
                            <h5 class="text-lg font-semibold">{{ $tutorial->name }}</h5>
                            <p>{{ $tutorial->description }}</p>
                        </div>
                        <div>{!! $tutorial->tutorial !!}</div>
                    </div>
                    <p><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($tutorial->deadline)->format('d F Y') }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal HTML -->
    <div id="confirmSubmitModal"
        class="fixed z-10 inset-0 overflow-y-auto transition-opacity ease-in-out duration-300 hidden">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity ease-in-out duration-300" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75 transition-all ease-in-out duration-300"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div id="confirmSubmitModalContent"
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all ease-in-out duration-300 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full opacity-0 translate-y-4 blur-sm">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i data-feather="info"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Konfirmasi Submit
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Apakah Anda yakin ingin submit kode ini? Berikut adalah preview screenshot yang akan
                                    disimpan.
                                </p>
                                <img id="screenshot-preview" class="mt-2 rounded-md shadow-md" src=""
                                    alt="Screenshot Preview">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
                        id="confirm-submit">
                        Submit
                    </button>
                    <button type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        id="cancel-submit">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/xml/xml.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/css/css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/javascript/javascript.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/theme/material-darker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/hint/show-hint.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/hint/show-hint.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/hint/html-hint.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/hint/css-hint.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/hint/javascript-hint.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/edit/closetag.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/edit/matchtags.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/hint/anyword-hint.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/search/matchesonscrollbar.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/search/searchcursor.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/search/search.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/search/jump-to-line.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/search/matchesonscrollbar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/search/match-highlighter.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            feather.replace();
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function(tooltipElement) {
                new bootstrap.Tooltip(tooltipElement);
            });

            // Handle Toggle Livecode
            const toggleLivecodeBtn = document.getElementById('toggle-livecode');
            const toggleSizeBtn = document.getElementById('toggle-size');
            const livecodeContainer = document.getElementById('livecode-container');
            const controlButtons = document.getElementById('control-buttons');
            const editorContainer = document.getElementById('editor-container');


            toggleLivecodeBtn.addEventListener('click', () => {
                livecodeContainer.classList.toggle('translate-y-full');
                controlButtons.classList.toggle('translate-y-56');
                tailwindBtn.classList.toggle('hidden');
                bootstrapBtn.classList.toggle('hidden');

                // Ubah teks tombol
                if (livecodeContainer.classList.contains('translate-y-full')) {
                    toggleLivecodeBtn.textContent = 'Open Koding';
                } else {
                    toggleLivecodeBtn.textContent = 'Hide Koding';
                }
            });



            let cssFramework = 'tailwind'; // Default to Tailwind

            const htmlEditor = CodeMirror.fromTextArea(document.getElementById('html-editor'), {
                mode: 'xml',
                theme: 'material-darker',
                lineNumbers: true,
                autoCloseTags: true,
                extraKeys: {
                    'Ctrl-Space': 'autocomplete',
                    'Ctrl-F': 'findPersistent', // Add this line for search functionality
                }
            });

            const cssEditor = CodeMirror.fromTextArea(document.getElementById('css-editor'), {
                mode: 'css',
                theme: 'material-darker',
                lineNumbers: true,
                autoCloseBrackets: true,
                extraKeys: {
                    'Ctrl-Space': 'autocomplete',
                    'Ctrl-F': 'findPersistent', // Add this line for search functionality
                }
            });

            const jsEditor = CodeMirror.fromTextArea(document.getElementById('js-editor'), {
                mode: 'javascript',
                theme: 'material-darker',
                lineNumbers: true,
                autoCloseBrackets: true,
                extraKeys: {
                    'Ctrl-Space': 'autocomplete',
                    'Ctrl-F': 'findPersistent', // Add this line for search functionality
                }
            });

            let scriptsLoaded = false; // Flag to check if scripts are already loaded

            function updatePreview() {
                const previewFrame = document.getElementById('preview');
                const preview = previewFrame.contentDocument || previewFrame.contentWindow.document;
                let cssLink = '';
                let jsLink = ''; // Tambahkan variabel untuk skrip JavaScript

                if (cssFramework === 'tailwind') {
                    cssLink =
                        '<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">';
                } else if (cssFramework === 'bootstrap') {
                    cssLink =
                        '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">';
                    jsLink =
                        '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></' +
                        'script>';

                }

                const jsCode = jsEditor.getValue().replace(/<\/script>/g, '<\\/script>');
                const isModule = jsCode.includes('import');

                preview.open();
                preview.write(`
        <!DOCTYPE html>
        <html>
        <head>
            ${cssLink}
            <style>${cssEditor.getValue()}</style>
        </head>
        <body>
            ${htmlEditor.getValue()}
            ${jsLink}
        </body>
        </html>
    `);
                preview.close();

                // Tambahkan script JavaScript
                const userScript = preview.createElement('script');
                userScript.type = isModule ? 'module' : 'text/javascript';
                userScript.text = jsCode;
                preview.body.appendChild(userScript);

                // Helper function to dynamically load external scripts
                function loadScript(src, type = 'text/javascript') {
                    return new Promise((resolve, reject) => {
                        const existingScript = Array.from(preview.scripts).find(script => script.src ===
                            src);
                        if (existingScript) {
                            resolve();
                            return;
                        }

                        const script = preview.createElement('script');
                        script.src = src;
                        script.type = type;
                        script.onload = resolve;
                        script.onerror = (error) => {
                            console.error(`Error loading script: ${src}`, error);
                            reject(error);
                        };
                        preview.body.appendChild(script);
                    });
                }

                if (!scriptsLoaded) {
                    const threeJsVersion = '128'; // Consistent versioning
                    const datGuiVersion = '0.7.6'; // Ensure compatibility
                    const jQueryVersion = '3.6.0'; // jQuery version
                    const gsapVersion = '3.6.0'; // GSAP version

                    // Only add the scripts if they are not already present
                    const promises = [];
                    if (!Array.from(preview.scripts).some(script => script.src.includes('three.min.js'))) {
                        promises.push(loadScript(
                            `https://cdnjs.cloudflare.com/ajax/libs/three.js/r${threeJsVersion}/three.min.js`
                        ));
                    }
                    if (!Array.from(preview.scripts).some(script => script.src.includes('dat.gui.min.js'))) {
                        promises.push(loadScript(
                            `https://cdn.jsdelivr.net/npm/dat.gui@${datGuiVersion}/build/dat.gui.min.js`));
                    }
                    if (!Array.from(preview.scripts).some(script => script.src.includes('jquery.min.js'))) {
                        promises.push(loadScript(
                            `https://cdnjs.cloudflare.com/ajax/libs/jquery/${jQueryVersion}/jquery.min.js`));
                    }
                    if (!Array.from(preview.scripts).some(script => script.src.includes('gsap.min.js'))) {
                        promises.push(loadScript(
                            `https://cdnjs.cloudflare.com/ajax/libs/gsap/${gsapVersion}/gsap.min.js`));
                    }

                    Promise.all(promises).then(() => {
                        scriptsLoaded = true; // Set the flag to true after loading scripts
                    }).catch(error => {
                        console.error('Error loading scripts:', error);
                    });
                }
            }



            htmlEditor.on('change', updatePreview);
            cssEditor.on('change', updatePreview);
            jsEditor.on('change', updatePreview);

            updatePreview();

            // Handle tab switching
            const htmlTab = document.getElementById('html-tab');
            const cssTab = document.getElementById('css-tab');
            const jsTab = document.getElementById('js-tab');
            const activeTab = document.getElementById('active-tab');

            function setActiveTab(tabElement) {
                // Reset all tabs
                htmlTab.classList.remove('bg-blue-600', 'scale-110');
                cssTab.classList.remove('bg-blue-600', 'scale-110');
                jsTab.classList.remove('bg-blue-600', 'scale-110');
                htmlTab.classList.add('bg-gray-700');
                cssTab.classList.add('bg-gray-700');
                jsTab.classList.add('bg-gray-700');

                // Set active tab
                tabElement.classList.remove('bg-gray-700');
                tabElement.classList.add('bg-blue-600', 'scale-110');
            }

            function showEditor(editor, tabName, tabElement) {
                htmlEditor.getWrapperElement().style.display = 'none';
                cssEditor.getWrapperElement().style.display = 'none';
                jsEditor.getWrapperElement().style.display = 'none';

                editor.getWrapperElement().style.display = 'block';
                editor.refresh();
                activeTab.textContent = tabName;
                setActiveTab(tabElement);
            }

            htmlTab.addEventListener('click', () => showEditor(htmlEditor, 'HTML', htmlTab));
            cssTab.addEventListener('click', () => showEditor(cssEditor, 'CSS', cssTab));
            jsTab.addEventListener('click', () => showEditor(jsEditor, 'JavaScript', jsTab));

            // Show HTML editor by default
            showEditor(htmlEditor, 'HTML', htmlTab);

            // Handle CSS Framework switching
            const tailwindBtn = document.getElementById('tailwind-btn');
            const bootstrapBtn = document.getElementById('bootstrap-btn');

            tailwindBtn.addEventListener('click', () => {
                cssFramework = 'tailwind';
                updatePreview();

                // Update tooltip text
                tailwindBtn.setAttribute('data-bs-original-title', 'Tailwind Framework Aktif');
                bootstrapBtn.setAttribute('data-bs-original-title', 'Aktifkan Framework Bootstrap');

                // Refresh tooltip for tailwindBtn
                const tailwindTooltip = bootstrap.Tooltip.getInstance(tailwindBtn);
                tailwindTooltip.setContent({
                    '.tooltip-inner': 'Tailwind Framework Aktif'
                });
                tailwindTooltip.show();

                // Hide tooltip for bootstrapBtn if it is shown
                const bootstrapTooltip = bootstrap.Tooltip.getInstance(bootstrapBtn);
                bootstrapTooltip.hide();
            });

            bootstrapBtn.addEventListener('click', () => {
                cssFramework = 'bootstrap';
                updatePreview();

                // Update tooltip text
                bootstrapBtn.setAttribute('data-bs-original-title', 'Bootstrap Framework Aktif');
                tailwindBtn.setAttribute('data-bs-original-title', 'Aktifkan Framework Tailwind');

                // Refresh tooltip for bootstrapBtn
                const bootstrapTooltip = bootstrap.Tooltip.getInstance(bootstrapBtn);
                bootstrapTooltip.setContent({
                    '.tooltip-inner': 'Bootstrap Framework Aktif'
                });
                bootstrapTooltip.show();

                // Hide tooltip for tailwindBtn if it is shown
                const tailwindTooltip = bootstrap.Tooltip.getInstance(tailwindBtn);
                tailwindTooltip.hide();
            });

            // Handle Submit
            const submitButton = document.getElementById('submit-button');
            const confirmSubmitModal = document.getElementById('confirmSubmitModal');
            const confirmSubmitModalContent = document.getElementById('confirmSubmitModalContent');
            const cancelSubmitButton = document.getElementById('cancel-submit');
            const confirmSubmitButton = document.getElementById('confirm-submit');
            const screenshotPreview = document.getElementById('screenshot-preview');

            submitButton.addEventListener('click', () => {
                const previewFrame = document.getElementById('preview');
                html2canvas(previewFrame.contentWindow.document.body).then(canvas => {
                    const screenshotData = canvas.toDataURL('image/png');
                    screenshotPreview.src = screenshotData;
                    confirmSubmitModal.classList.remove('hidden');
                    setTimeout(() => {
                        confirmSubmitModalContent.classList.remove('opacity-0',
                            'translate-y-4', 'blur-sm');
                        confirmSubmitModalContent.classList.add('opacity-100',
                            'translate-y-0', 'blur-none');
                    }, 10); // delay for smooth transition
                });
            });

            cancelSubmitButton.addEventListener('click', () => {
                confirmSubmitModalContent.classList.add('opacity-0', 'translate-y-4', 'blur-sm');
                confirmSubmitModalContent.classList.remove('opacity-100', 'translate-y-0', 'blur-none');
                setTimeout(() => {
                    confirmSubmitModal.classList.add('hidden');
                }, 300); // match the duration of the animation
            });

            submitButton.addEventListener('click', () => {
                const previewFrame = document.getElementById('preview');
                const previewDoc = previewFrame.contentDocument || previewFrame.contentWindow.document;
                html2canvas(previewDoc.body).then(canvas => {
                    const screenshotData = canvas.toDataURL('image/png');
                    screenshotPreview.src = screenshotData;

                    // Ambil semua tag <link> untuk CSS
                    const links = Array.from(previewDoc.querySelectorAll('link[rel="stylesheet"]'))
                        .map(link => link.outerHTML).join('');

                    // Ambil semua tag <script> untuk JavaScript yang berisi src saja
                    const scripts = Array.from(previewDoc.querySelectorAll('script[src]'))
                        .map(script => script.outerHTML).join('');

                    confirmSubmitModal.classList.remove('hidden');
                    setTimeout(() => {
                        confirmSubmitModalContent.classList.remove('opacity-0',
                            'translate-y-4', 'blur-sm');
                        confirmSubmitModalContent.classList.add('opacity-100',
                            'translate-y-0', 'blur-none');
                    }, 10); // delay for smooth transition

                    // Tambahkan kode untuk mengirimkan data
                    confirmSubmitButton.addEventListener('click', () => {
                        const module_id = {{ $module->id }};
                        const html = htmlEditor.getValue();
                        const css = cssEditor.getValue();
                        const js = jsEditor.getValue();
                        const screenshot = screenshotPreview.src;

                        fetch('{{ route('user.save.progress') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                module_id,
                                html,
                                css,
                                js,
                                links,
                                scripts, // Mengirimkan script CDN yang benar
                                screenshot,
                                framework: cssFramework // Tambahkan framework ke JSON
                            })
                        }).then(response => response.json()).then(data => {
                            if (data.status === 'success') {
                                confirmSubmitModalContent.classList.add('opacity-0',
                                    'translate-y-4', 'blur-sm');
                                confirmSubmitModalContent.classList.remove(
                                    'opacity-100', 'translate-y-0', 'blur-none');
                                setTimeout(() => {
                                    confirmSubmitModal.classList.add(
                                        'hidden');
                                    window.location.href = data.redirect +
                                        '?message=' + encodeURIComponent(
                                            data.message);
                                }, 300); // match the duration of the animation
                            }
                        }).catch(error => {
                            console.error(error);
                            // Handle error
                        });
                    });


                });
            });



            // Snippets and Autocomplete
            const snippets = {
                html: [{
                        text: '<div>',
                        displayText: '<div> ... </div>'
                    },
                    {
                        text: '<span>',
                        displayText: '<span> ... </span>'
                    },
                    {
                        text: '<p>',
                        displayText: '<p> ... </p>'
                    }
                ],
                css: [{
                        text: 'color: ',
                        displayText: 'color: [value];'
                    },
                    {
                        text: 'background: ',
                        displayText: 'background: [value];'
                    },
                    {
                        text: 'margin: ',
                        displayText: 'margin: [value];'
                    }
                ],
                javascript: [{
                        text: 'function name() {\n\t\n}',
                        displayText: 'function name() { ... }'
                    },
                    {
                        text: 'console.log()',
                        displayText: 'console.log()'
                    },
                    {
                        text: 'document.getElementById()',
                        displayText: 'document.getElementById()'
                    }
                ]
            };

            CodeMirror.registerHelper('hint', 'html', function(editor) {
                const cur = editor.getCursor();
                const token = editor.getTokenAt(cur);
                const start = token.start;
                const end = cur.ch;
                const line = cur.line;
                const list = snippets.html;
                return {
                    list: list,
                    from: CodeMirror.Pos(line, start),
                    to: CodeMirror.Pos(line, end)
                };
            });

            CodeMirror.registerHelper('hint', 'css', function(editor) {
                const cur = editor.getCursor();
                const token = editor.getTokenAt(cur);
                const start = token.start;
                const end = cur.ch;
                const line = cur.line;
                const list = snippets.css;
                return {
                    list: list,
                    from: CodeMirror.Pos(line, start),
                    to: CodeMirror.Pos(line, end)
                };
            });

            CodeMirror.registerHelper('hint', 'javascript', function(editor) {
                const cur = editor.getCursor();
                const token = editor.getTokenAt(cur);
                const start = token.start;
                const end = cur.ch;
                const line = cur.line;
                const list = snippets.javascript;
                return {
                    list: list,
                    from: CodeMirror.Pos(line, start),
                    to: CodeMirror.Pos(line, end)
                };
            });

            // Enable autocompletion on "." and "#"
            htmlEditor.on('inputRead', function(editor, change) {
                if (change.text[0] === '.' || change.text[0] === '#') {
                    editor.showHint();
                }
            });

            // Enable auto-closing of tags and brackets
            CodeMirror.commands.autocomplete = function(cm) {
                cm.showHint({
                    completeSingle: false
                });
            };
            // Get the CodeMirror wrapper elements for each editor
            const htmlEditorWrapper = htmlEditor.getWrapperElement();
            const cssEditorWrapper = cssEditor.getWrapperElement();
            const jsEditorWrapper = jsEditor.getWrapperElement();

            toggleSizeBtn.addEventListener('click', () => {
                livecodeContainer.classList.toggle('h-[80vh]');
                livecodeContainer.classList.toggle('bottom-0');
                controlButtons.classList.toggle('-translate-y-[30rem]');
                editorContainer.classList.toggle('h-full');

                // Toggle height of CodeMirror editors
                if (livecodeContainer.classList.contains('h-[80vh]')) {
                    toggleSizeBtn.textContent = 'Shrink Koding';
                    htmlEditorWrapper.style.height = '100%';
                    cssEditorWrapper.style.height = '100%';
                    jsEditorWrapper.style.height = '100%';
                } else {
                    toggleSizeBtn.textContent = 'Expand Koding';
                    htmlEditorWrapper.style.height = '';
                    cssEditorWrapper.style.height = '';
                    jsEditorWrapper.style.height = '';
                }
            });
        });
    </script>
@endpush
