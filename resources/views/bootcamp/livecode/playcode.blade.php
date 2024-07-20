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
            <div class="flex fap-4">
                <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" role="button"
                    aria-controls="offcanvasExample"
                    class="p-2 bg-red-500 hover:bg-red-400 rounded text-white transition-all ease-in-out mr-2">Tutorial</button>
                <button id="toggle-livecode"
                    class="p-2 bg-gray-800 hover:bg-gray-700 rounded text-white transition-all ease-in-out mr-2">Hide
                    Koding</button>
            </div>
        </div>

        <!-- Livecode Area -->
        <div id="livecode-container"
            class="fixed bottom-5 h-80 overflow-hidden left-5 right-5 rounded-md flex bg-gray-900 text-white transform transition-transform duration-300">
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

    <div class="offcanvas -translate-x-full fixed top-0 start-0 border-r border-gray-300 transition-all duration-300 transform h-full invisible bg-white z-50 max-w-lg"
        tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="flex items-center p-4">
            <h5 class="text-lg" id="offcanvasExampleLabel">Offcanvas</h5>
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
        <div class="p-4">
            <div>Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images,
                lists, etc.</div>
            <div class="dropdown mt-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">Dropdown
                    button</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            feather.replace();
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function(tooltipElement) {
                new bootstrap.Tooltip(tooltipElement);
            });

            let cssFramework = 'tailwind'; // Default to Tailwind

            const htmlEditor = CodeMirror.fromTextArea(document.getElementById('html-editor'), {
                mode: 'xml',
                theme: 'material-darker',
                lineNumbers: true,
                autoCloseTags: true,
                extraKeys: {
                    'Ctrl-Space': 'autocomplete'
                }
            });

            const cssEditor = CodeMirror.fromTextArea(document.getElementById('css-editor'), {
                mode: 'css',
                theme: 'material-darker',
                lineNumbers: true,
                autoCloseBrackets: true,
                extraKeys: {
                    'Ctrl-Space': 'autocomplete'
                }
            });

            const jsEditor = CodeMirror.fromTextArea(document.getElementById('js-editor'), {
                mode: 'javascript',
                theme: 'material-darker',
                lineNumbers: true,
                autoCloseBrackets: true,
                extraKeys: {
                    'Ctrl-Space': 'autocomplete'
                }
            });

            function updatePreview() {
                const previewFrame = document.getElementById('preview');
                const preview = previewFrame.contentDocument || previewFrame.contentWindow.document;
                let cssLink = '';

                if (cssFramework === 'tailwind') {
                    cssLink =
                        '<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">';
                } else if (cssFramework === 'bootstrap') {
                    cssLink =
                        '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">';
                }

                preview.open();
                preview.write(`
                    ${cssLink}
                    <style>${cssEditor.getValue()}</style>
                    ${htmlEditor.getValue()}
                    <script>${jsEditor.getValue()}<\/script>
                `);
                preview.close();
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

            // Handle Toggle Livecode
            const toggleLivecodeBtn = document.getElementById('toggle-livecode');
            const livecodeContainer = document.getElementById('livecode-container');
            const controlButtons = document.getElementById('control-buttons');

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
        });
    </script>
@endpush
