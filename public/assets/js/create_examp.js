const questionsContainer = document.getElementById('questions-container')
const addQuestionBtn = document.getElementById('add-question')
const formElement = document.getElementById('form-create')

const app = {
    lengthAnswers: 4,
    lengthQuestions: 3,
    submitForm: function () {
        const _this = this

        formElement.onsubmit = function (e) {
            e.preventDefault()

            const questionsValue = document.querySelectorAll('input[name="question"]')
            const answersValue = document.querySelectorAll('input[name="answer"]')
            let x = _this.validate([questionsValue, answersValue])

            if (!x) {

            } else {
                let values = []
                Array.from(questionsValue).forEach((ques) => {
                    let arrAnswers = []
                    let answer = 0
                    let type = 0
                    const radio_type = ques.closest('.query').querySelectorAll('input[name="radio-type"]')

                    Array.from(radio_type).forEach((e, index) => {
                        if (e.checked) {
                            type = index
                        }
                    })

                    const answers = ques.closest('.query').querySelectorAll('.answer')
                    console.log(answers);

                    Array.from(answers).forEach((e, index) => {
                        const answerValue = e.querySelector('input[name="answer"]').value
                        arrAnswers.push(answerValue)

                        const answerRadioBtn = e.querySelector('input[name="correct-answer"]')
                        if (answerRadioBtn.checked) {
                            answer = index
                        }
                    })

                    const obj = {
                        'question': ques.value,
                        'type': type,
                        'answers': arrAnswers,
                        'correct-answer': answer
                    }

                    values.push(obj)
                })

                $.ajax({
                    type: 'POST',
                    url: '/api/bai-thi/tao-bai-thi/buoc-2',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    data: JSON.stringify(values),
                    success: function (response) {
                        console.log(response)
                    },
                    error: function (xhr, status, error) {
                        console.log(status)
                        console.log(error)
                    }
                });
            }

            return true
        }
    },
    handleEvent: function () {
        const _this = this;

        questionsContainer.addEventListener('click', function (event) {
            const target = event.target;

            // Xóa câu hỏi
            if (target.classList.contains('delete-question')) {
                const questionElement = target.closest('.question');
                const answersContainer = questionElement.querySelector('.answers');

                if (questionsContainer.children.length === _this.lengthQuestions) {
                    addQuestionBtn.style.display = 'block';
                }

                questionElement.remove();
                _this.renderQuestionIndex();
            }

            // Xóa câu trả lời
            if (target.classList.contains('delete-answer')) {
                const answerElement = target.closest('.answer');
                const answersContainer = answerElement.closest('.answers');
                const addAnswerBtn = answersContainer.nextElementSibling

                answerElement.remove();

                // Hiển thị lại nút "Thêm câu trả lời" nếu số lượng câu trả lời đạt giới hạn
                if (answersContainer.children.length < _this.lengthAnswers) {
                    addAnswerBtn.style.display = 'block';
                }
            }

            if (target.classList.contains('add-answer')) {
                const answersContainer = target.parentNode.querySelector('.answers');
                const addAnswerBtn = answersContainer.nextElementSibling
                const answerTemplate = document.getElementById('answer-template');
                const answer = answerTemplate.content.cloneNode(true);
                answersContainer.appendChild(answer);

                if (answersContainer.children.length >= _this.lengthAnswers) {
                    addAnswerBtn.style.display = 'none';
                }
            }
        });

        addQuestionBtn.addEventListener('click', function () {
            const questionTemplate = document.getElementById('question-template');
            const question = questionTemplate.content.cloneNode(true);

            questionsContainer.appendChild(question);

            if (questionsContainer.children.length >= _this.lengthQuestions) {
                addQuestionBtn.style.display = 'none';
            }

            _this.renderQuestionIndex();
        });
    },
    renderQuestionIndex: function () {
        questionsContainer.querySelectorAll('.question .question-number').forEach((e, index) => {
            e.textContent = index + 1
        })
    },
    validate: function (elements) {
        let countErr = 0
        elements.forEach(ev => {
            ev.forEach(e => {
                const formMessage = e.closest('.query').querySelector('.form-message')
                if (e.value.trim() == '') {
                    formMessage.textContent = 'Vui lòng nhập dữ liệu cho phần này!'
                    countErr++
                } else {
                    formMessage.textContent = ''
                }
            })
        })

        return (countErr == 0)
    },
    start: function () {
        this.submitForm()
        this.handleEvent()
    }
}

app.start()
