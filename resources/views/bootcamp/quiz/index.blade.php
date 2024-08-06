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
                    <button id="previous-question"
                        class="py-2 px-4 bg-gray-600 text-white rounded-lg hover:bg-gray-800 disabled:opacity-50 disabled:pointer-events-none">Previous</button>
                    <button id="next-question"
                        class="py-2 px-4 bg-indigo-600 text-white rounded-lg hover:bg-indigo-800 disabled:opacity-50 disabled:pointer-events-none">Next</button>
                    <button id="open-submit-modal"
                        class="py-2 px-4 bg-green-600 text-white rounded-lg hover:bg-green-800 disabled:opacity-50 disabled:pointer-events-none hidden">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Confirmation Modal -->
    <div id="submit-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full opacity-0 translate-y-4"
                id="submit-modal-content">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 18h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Yakin ingin submit?
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Pastikan semua jawaban sudah benar sebelum submit.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="confirm-submit"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Submit
                    </button>
                    <button id="cancel-submit"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Result Modal -->
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
                                    Congratulations! You have completed the quiz. Your score is <span
                                        id="quiz-score"></span>.
                                </p>
                                <p class="text-sm text-gray-500">Keep up the good work and continue learning!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="close-modal"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Close
                    </button>
                    <button id="retry-quiz"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Retry Quiz
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quizData = @json($questions);
            const moduleId = {{ $module_id }};
            let currentQuestionIndex = 0;
            let answers = [];
            const quizContainer = document.getElementById('quiz-container');
            const nextButton = document.getElementById('next-question');
            const previousButton = document.getElementById('previous-question');
            const openSubmitModalButton = document.getElementById('open-submit-modal');
            const submitButton = document.getElementById('confirm-submit');
            const cancelSubmitButton = document.getElementById('cancel-submit');

            function renderQuestion() {
                const question = quizData[currentQuestionIndex];
                const savedAnswer = answers[currentQuestionIndex] ? answers[currentQuestionIndex].answer : null;
                quizContainer.innerHTML = `
                    <div class="p-4 bg-white rounded-lg shadow">
                        <h2 class="text-2xl font-semibold mb-4">${question.question}</h2>
                        <div class="grid grid-cols-2 gap-4">
                            ${question.answers.map((option, index) => `
                                    <label class="block bg-gray-200 rounded-lg p-4 cursor-pointer hover:bg-gray-300">
                                        <input type="radio" name="answer" value="${option}" class="mr-2" ${savedAnswer === option ? 'checked' : ''}>${option}
                                    </label>
                                `).join('')}
                        </div>
                    </div>
                `;
            }

            function nextQuestion() {
                const selectedOption = document.querySelector('input[name="answer"]:checked');
                if (selectedOption) {
                    answers[currentQuestionIndex] = {
                        question: quizData[currentQuestionIndex].question,
                        answer: selectedOption.value
                    };
                    currentQuestionIndex++;
                    if (currentQuestionIndex < quizData.length) {
                        renderQuestion();
                        handleNavigation();
                    } else {
                        openSubmitModal();
                    }
                } else {
                    alert('Please select an answer before proceeding.');
                }
            }

            function previousQuestion() {
                if (currentQuestionIndex > 0) {
                    const selectedOption = document.querySelector('input[name="answer"]:checked');
                    if (selectedOption) {
                        answers[currentQuestionIndex] = {
                            question: quizData[currentQuestionIndex].question,
                            answer: selectedOption.value
                        };
                    }
                    currentQuestionIndex--;
                    renderQuestion();
                    handleNavigation();
                }
            }

            function handleNavigation() {
                previousButton.disabled = currentQuestionIndex === 0;
                nextButton.classList.toggle('hidden', currentQuestionIndex === quizData.length - 1);
                openSubmitModalButton.classList.toggle('hidden', currentQuestionIndex !== quizData.length - 1);
            }

            nextButton.addEventListener('click', nextQuestion);
            previousButton.addEventListener('click', previousQuestion);
            openSubmitModalButton.addEventListener('click', openSubmitModal);

            function openSubmitModal() {
                const submitModal = document.getElementById('submit-modal');
                const submitModalContent = document.getElementById('submit-modal-content');
                submitModal.classList.remove('hidden');
                setTimeout(() => {
                    submitModalContent.classList.remove('translate-y-4', 'opacity-0');
                    submitModalContent.classList.add('translate-y-0', 'opacity-100');
                }, 50);
            }

            cancelSubmitButton.addEventListener('click', closeSubmitModal);

            function closeSubmitModal() {
                const submitModalContent = document.getElementById('submit-modal-content');
                submitModalContent.classList.add('translate-y-4', 'opacity-0');
                setTimeout(() => {
                    document.getElementById('submit-modal').classList.add('hidden');
                }, 300);
            }

            submitButton.addEventListener('click', function() {
                closeSubmitModal();
                submitQuiz();
            });

            function submitQuiz() {
                const selectedOption = document.querySelector('input[name="answer"]:checked');
                if (selectedOption) {
                    answers[currentQuestionIndex] = {
                        question: quizData[currentQuestionIndex].question,
                        answer: selectedOption.value
                    };
                }
                fetch('{{ route('user.submit.quiz') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            module_id: moduleId,
                            answers: answers
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        showResultModal(data.score);
                    })
                    .catch(error => console.error('Error:', error));
            }

            function showResultModal(score) {
                const resultModal = document.getElementById('result-modal');
                const resultModalContent = document.getElementById('result-modal-content');
                const quizScore = document.getElementById('quiz-score');
                quizScore.textContent = `${score}%`;
                resultModal.classList.remove('hidden');
                setTimeout(() => {
                    resultModalContent.classList.remove('translate-y-4', 'opacity-0');
                    resultModalContent.classList.add('translate-y-0', 'opacity-100');
                }, 50);
                const closeModalButton = document.getElementById('close-modal');
                const retryQuizButton = document.getElementById('retry-quiz');
                closeModalButton.addEventListener('click', function() {
                    resultModalContent.classList.add('translate-y-4', 'opacity-0');
                    setTimeout(() => {
                        resultModal.classList.add('hidden');
                        window.location.href = '{{ route('user.dashboard') }}';
                    }, 300);
                });
                retryQuizButton.addEventListener('click', function() {
                    resultModalContent.classList.add('translate-y-4', 'opacity-0');
                    setTimeout(() => {
                        resultModal.classList.add('hidden');
                        currentQuestionIndex = 0;
                        answers = [];
                        renderQuestion();
                        handleNavigation();
                    }, 300);
                });
            }

            // Initialize quiz
            renderQuestion();
            handleNavigation();
        });
    </script>
@endsection
