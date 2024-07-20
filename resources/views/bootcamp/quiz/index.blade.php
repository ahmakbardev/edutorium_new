@extends('user.layouts.layout')

@section('content')
    <div class="mx-6 my-4 grid grid-cols-1 gap-6">
        <div class="card h-full shadow">
            <div class="border-b border-gray-300 px-5 py-4 flex items-center justify-between">
                <div>
                    <h4 class="font-semibold text-2xl">Quiz</h4>
                </div>
            </div>

            <div class="relative overflow-x-auto p-4">
                <div id="quiz-container" class="grid grid-cols-1 gap-4 max-w-3xl mx-auto">
                    <!-- Quiz will be dynamically inserted here -->
                </div>
                <div class="flex justify-between mt-4">
                    <button id="next-question"
                        class="py-2 px-4 bg-indigo-600 text-white rounded-lg hover:bg-indigo-800 disabled:opacity-50 disabled:pointer-events-none">Next</button>
                    <button id="submit-quiz"
                        class="py-2 px-4 bg-green-600 text-white rounded-lg hover:bg-green-800 disabled:opacity-50 disabled:pointer-events-none">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div id="result-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full opacity-0 translate-y-4"
                id="result-modal-content">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Quiz Result
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Your score is <span id="quiz-score"></span>.
                                </p>
                                <p class="text-sm text-gray-500">
                                    Correct answers:
                                </p>
                                <ul id="correct-answers-list" class="list-disc ml-5 text-sm text-gray-500"></ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="close-modal"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="answer-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full opacity-0 translate-y-4"
                id="answer-modal-content">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div id="answer-icon"
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg id="answer-icon-svg" class="h-6 w-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path id="answer-icon-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="answer-modal-title">
                                Answer Result
                            </h3>
                            <div class="mt-2">
                                <p id="answer-modal-message" class="text-sm text-gray-500"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="close-answer-modal"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="warning-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full opacity-0 translate-y-4"
                id="warning-modal-content">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="warning-modal-title">
                                Warning!
                            </h3>
                            <div class="mt-2">
                                <p id="warning-modal-message" class="text-sm text-gray-500">If you refresh or go back, the
                                    quiz will end and you will be scored based on the answers you have provided so far. Do
                                    you wish to proceed?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="proceed-warning-modal"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Proceed
                    </button>
                    <button id="cancel-warning-modal"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quizData = @json($questions);
            const moduleId = {{ $module_id }};
            const lastMateri = @json($lastMateri);
            let currentQuestionIndex = 0;
            let correctAnswers = 0; // Menghitung jawaban benar
            let countdown;
            const quizContainer = document.getElementById('quiz-container');
            const nextButton = document.getElementById('next-question');
            const submitButton = document.getElementById('submit-quiz');
            const resultModal = document.getElementById('result-modal');
            const resultModalContent = document.getElementById('result-modal-content');
            const closeModalButton = document.getElementById('close-modal');
            const quizScore = document.getElementById('quiz-score');
            const correctAnswersList = document.getElementById('correct-answers-list');
            const answerModal = document.getElementById('answer-modal');
            const answerModalContent = document.getElementById('answer-modal-content');
            const closeAnswerModalButton = document.getElementById('close-answer-modal');
            const answerModalTitle = document.getElementById('answer-modal-title');
            const answerModalMessage = document.getElementById('answer-modal-message');
            const answerIcon = document.getElementById('answer-icon');
            const answerIconSvg = document.getElementById('answer-icon-svg');
            const answerIconPath = document.getElementById('answer-icon-path');
            const warningModal = document.getElementById('warning-modal');
            const warningModalContent = document.getElementById('warning-modal-content');
            const proceedWarningModalButton = document.getElementById('proceed-warning-modal');
            const cancelWarningModalButton = document.getElementById('cancel-warning-modal');
            let isNavigating = false;

            // Disable right-click context menu
            document.addEventListener('contextmenu', function(event) {
                event.preventDefault();
            });

            // Disable developer tools shortcuts and handle Ctrl+U
            document.addEventListener('keydown', function(event) {
                if (event.key === 'F12' || (event.ctrlKey && event.shiftKey && event.key === 'I') || (event
                        .ctrlKey && event.shiftKey && event.key === 'J')) {
                    event.preventDefault();
                }
                if (event.ctrlKey && event.key === 'u') {
                    event.preventDefault();
                    const newWindow = window.open();
                    newWindow.document.write('');
                    newWindow.document.close();
                }
            });

            // Detect back button click
            history.pushState(null, null, location.href);
            window.addEventListener('popstate', function(event) {
                event.preventDefault();
                history.pushState(null, null, location.href);
                showWarningModal();
            });

            // Detect refresh button click
            document.addEventListener('keydown', function(event) {
                if (event.key === 'F5' || (event.ctrlKey && event.key === 'r')) {
                    event.preventDefault();
                    showWarningModal();
                }
            });

            // Detect refresh button click using mouse
            window.addEventListener('beforeunload', function(event) {
                if (!isNavigating) {
                    event.preventDefault();
                    event.returnValue = '';
                    showWarningModal();
                    return '';
                }
            });

            function showWarningModal() {
                warningModal.classList.remove('hidden');
                setTimeout(() => {
                    warningModalContent.classList.remove('translate-y-4', 'opacity-0');
                    warningModalContent.classList.add('translate-y-0', 'opacity-100');
                }, 50);

                // Save partial score on refresh or back button click
                savePartialQuizScore(correctAnswers, quizData.length, moduleId);
            }

            function savePartialQuizScore(correctAnswers, totalQuestions, moduleId) {
                const scoreOutOf1000 = Math.round((correctAnswers / totalQuestions) * 1000);
                fetch('{{ route('user.save.partial.quiz.score') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            score: scoreOutOf1000,
                            module_id: moduleId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Partial quiz score saved successfully');
                    })
                    .catch(error => console.error('Error:', error));
            }

            function hideWarningModal() {
                warningModalContent.classList.add('translate-y-4', 'opacity-0');
                setTimeout(() => {
                    warningModal.classList.add('hidden');
                }, 300);
            }

            proceedWarningModalButton.addEventListener('click', function() {
                clearInterval(countdown);
                hideWarningModal();
                isNavigating = true;
                window.onbeforeunload = null;
                saveQuizScore(correctAnswers, quizData.length, moduleId, true);
            });

            cancelWarningModalButton.addEventListener('click', function() {
                hideWarningModal();
            });

            function renderQuestion() {
                const question = quizData[currentQuestionIndex];
                if (!question) {
                    console.error('Question data is undefined.');
                    return;
                }
                quizContainer.innerHTML = `
        <div class="p-4 bg-white rounded-lg shadow">
            ${question.image ? `<img src="${question.image}" alt="Question Image" class="mb-4 w-full h-48 object-cover">` : ''}
            <h2 class="text-2xl font-semibold mb-4">${question.question}</h2>
            <div class="grid grid-cols-2 gap-4">
                ${question.answers.map((option, index) => `
                        <label class="block bg-gray-200 rounded-lg p-4 cursor-pointer hover:bg-gray-300">
                            <input type="radio" name="answer" value="${option}" class="mr-2">${option}
                        </label>
                    `).join('')}
            </div>
            <div class="mt-4 relative">
                <p id="timer" class="text-red-500 font-bold mb-2"></p>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div id="time-bar" class="bg-red-500 h-2.5 rounded-full transition-all linear"></div>
                </div>
            </div>
        </div>
    `;
                startTimer(question.timeLimit); // Menggunakan time limit dari data
            }


            function startTimer(seconds) {
                clearInterval(countdown); // Clear any existing countdown
                const timerElement = document.getElementById('timer');
                const timeBar = document.getElementById('time-bar');
                timerElement.textContent = `Time left: ${seconds} seconds`;
                timeBar.style.transitionDuration = `${seconds}s`;
                timeBar.style.width = '100%';

                setTimeout(() => {
                    timeBar.style.width = '0%';
                }, 50);

                countdown = setInterval(() => {
                    seconds--;
                    timerElement.textContent = `Time left: ${seconds} seconds`;

                    if (seconds <= 0) {
                        clearInterval(countdown);
                        checkAnswer();
                    }
                }, 1000);
            }

            function checkAnswer() {
                clearInterval(countdown); // Clear the timer when checking the answer
                const selectedOption = document.querySelector('input[name="answer"]:checked');
                const correctAnswer = quizData[currentQuestionIndex].answers[quizData[currentQuestionIndex]
                    .correct - 1];
                let isCorrect = false;
                if (selectedOption && selectedOption.value === correctAnswer) {
                    correctAnswers++;
                    isCorrect = true;
                }
                showAnswerModal(isCorrect, correctAnswer);
            }

            function handleNavigation() {
                nextButton.disabled = currentQuestionIndex >= quizData.length - 1;
                submitButton.disabled = currentQuestionIndex !== quizData.length - 1;
            }

            nextButton.addEventListener('click', function() {
                checkAnswer();
            });

            submitButton.addEventListener('click', function() {
                clearInterval(countdown); // Clear the timer when submitting
                saveQuizScore(correctAnswers, quizData.length, moduleId, false);
            });

            closeAnswerModalButton.addEventListener('click', function() {
                answerModalContent.classList.add('translate-y-4', 'opacity-0');
                setTimeout(() => {
                    answerModal.classList.add('hidden');
                    currentQuestionIndex++;
                    if (currentQuestionIndex < quizData.length) {
                        renderQuestion();
                        handleNavigation();
                    } else {
                        showResult();
                    }
                }, 300);
            });

            closeModalButton.addEventListener('click', function() {
                resultModalContent.classList.add('translate-y-4', 'opacity-0');
                setTimeout(() => {
                    resultModal.classList.add('hidden');
                }, 300);
            });

            function showAnswerModal(isCorrect, correctAnswer) {
                if (isCorrect) {
                    answerModalTitle.textContent = "Correct!";
                    answerModalMessage.textContent = "Good job!";
                    answerIcon.classList.replace('bg-red-100', 'bg-green-100');
                    answerIconSvg.classList.replace('text-red-600', 'text-green-600');
                    answerIconPath.setAttribute('d', 'M5 13l4 4L19 7');
                } else {
                    answerModalTitle.textContent = "Incorrect!";
                    answerModalMessage.textContent = `The correct answer is ${correctAnswer}.`;
                    answerIcon.classList.replace('bg-green-100', 'bg-red-100');
                    answerIconSvg.classList.replace('text-green-600', 'text-red-600');
                    answerIconPath.setAttribute('d', 'M6 18L18 6M6 6l12 12');
                }
                answerModal.classList.remove('hidden');
                setTimeout(() => {
                    answerModalContent.classList.remove('translate-y-4', 'opacity-0');
                    answerModalContent.classList.add('translate-y-0', 'opacity-100');
                }, 50);
            }

            function showResult() {
                const scoreOutOf1000 = Math.round((correctAnswers / quizData.length) * 1000);
                quizScore.textContent = `${scoreOutOf1000} / 1000`;
                correctAnswersList.innerHTML = quizData.map(q =>
                    `<li>${q.question} - ${q.answers[q.correct - 1]}</li>`).join('');
                resultModal.classList.remove('hidden');
                setTimeout(() => {
                    resultModalContent.classList.remove('translate-y-4', 'opacity-0');
                    resultModalContent.classList.add('translate-y-0', 'opacity-100');
                }, 50);

                // Disable the beforeunload event listener when the result modal is shown
                window.onbeforeunload = null;

                // Remove other event listeners that might cause the alert
                window.removeEventListener('beforeunload', handleBeforeUnload);
                document.removeEventListener('keydown', handleKeydown);

                // Tambahkan event listener untuk tombol pada modal result
                closeModalButton.addEventListener('click', function() {
                    if (lastMateri) {
                        const lastMateriSlug = lastMateri.split(' ').join('-').toLowerCase();
                        const moduleName = '{{ $module_name }}'.toLowerCase().replace(' ',
                            '-'); // Menggunakan module_name
                        window.location.href =
                            `{{ url('/user/bootcamp/modul') }}/${moduleName}/${lastMateriSlug}`;
                    } else {
                        window.location.href = '{{ route('user.dashboard') }}';
                    }
                });
            }

            function handleBeforeUnload(event) {
                event.preventDefault();
                event.returnValue = '';
            }

            function handleKeydown(event) {
                if (event.key === 'F5' || (event.ctrlKey && event.key === 'r')) {
                    handleBeforeUnload(event);
                }
            }

            // Initial event listeners
            window.onbeforeunload = handleBeforeUnload;
            document.addEventListener('keydown', handleKeydown);
            window.addEventListener('beforeunload', handleBeforeUnload);

            function saveQuizScore(correctAnswers, totalQuestions, moduleId, isProceed) {
                const scoreOutOf1000 = Math.round((correctAnswers / totalQuestions) * 1000);
                fetch('{{ route('user.save.quiz.score') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            score: scoreOutOf1000,
                            module_id: moduleId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (isProceed) {
                            showResult();
                        } else {
                            showResult();
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Initial event listeners
            window.onbeforeunload = handleBeforeUnload;
            document.addEventListener('keydown', handleKeydown);
            window.addEventListener('beforeunload', handleBeforeUnload);
            // Initialize quiz
            document.addEventListener('DOMContentLoaded', function() {
                // existing code...
                renderQuestion();
                handleNavigation();
            });
        });
    </script>
@endsection
