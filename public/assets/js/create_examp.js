const questionsContainer = document.getElementById('questions-container')
const addQuestionBtn = document.getElementById('add-question')
const formElement = document.getElementById('form-create')

const app = {
    lengthAnswers: 4,
    lengthQuestions: 3,
    id: 0,
    submitForm: function () {
        const _this = this

        formElement.onsubmit = function (e) {
            e.preventDefault()

            const questionsValue = document.querySelectorAll('.question-input')
            const answersValue = document.querySelectorAll('.answer-input')
            const questions = document.querySelectorAll('.question')
            let x = _this.validate([questionsValue, answersValue])
            let y = _this.validateRadio()

            if (!x || !y) {

            } else {
                let values = []
                Array.from(questions).forEach((ques) => {
                    let arrAnswers = []
                    let answer = 0
                    const radio_type = ques.querySelector('.radio-difficult:checked')
                    let type = radio_type.value

                    const answers = ques.querySelectorAll('.answer')

                    Array.from(answers).forEach((e, index) => {
                        const answerValue = e.querySelector('.answer-input').value
                        arrAnswers.push(answerValue)

                        const answerRadioBtn = e.querySelector('.correct-answer-radio')
                        if (answerRadioBtn.checked) {
                            answer = index + 1
                        }
                    })

                    const obj = {
                        'question': ques.querySelector('.question-input').value,
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
                        if (response.type === 'success') {
                            window.location.href = response.redirect;
                        }
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
                const questionNode = answersContainer.parentElement.getAttribute('data-index')
                console.log(questionNode);

                answer.querySelector('input').setAttribute('name', 'correct-answer-' + questionNode)

                answersContainer.appendChild(answer);

                if (answersContainer.children.length >= _this.lengthAnswers) {
                    addAnswerBtn.style.display = 'none';
                }
            }
        });

        addQuestionBtn.addEventListener('click', function () {
            const questionTemplate = document.getElementById('question-template');
            const question = questionTemplate.content.cloneNode(true);
            const dif = question.querySelectorAll('.radio-difficult');
            const qus = question.querySelector('.question')
            qus.dataset.index = _this.id

            dif.forEach(e => {
                e.setAttribute('name', 'difficult-' + qus.getAttribute('data-index'));
            })

            questionsContainer.appendChild(question);

            if (questionsContainer.children.length >= _this.lengthQuestions) {
                addQuestionBtn.style.display = 'none';
            }

            _this.id++;
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
                console.log(e);
                const name = e.getAttribute('name')
                const formMessage = e.closest(`.${name}`).querySelector('.form-message')
                if (e.value.trim() == '') {
                    formMessage.classList.remove('d-none')
                    formMessage.textContent = 'Vui lòng nhập dữ liệu cho phần này!'
                    countErr++
                } else {
                    formMessage.classList.add('d-none')
                    formMessage.textContent = ''
                }
            })
        })

        return (countErr == 0)
    },
    validateRadio: function () {
        let countErr = 0
        questionElement = document.querySelectorAll('.question')
        questionElement.forEach(e => {
            const formMessageType = e.querySelector('.form-message')
            const formMessage = e.querySelectorAll('.form-message')

            const formMessageAnswer = formMessage[formMessage.length - 1]

            const radioGroupType = e.querySelector('.radio-difficult:checked')
            if (!radioGroupType) {
                formMessageType.classList.remove('d-none')
                formMessageType.textContent = 'Vui lòng chọn độ khó cho câu hỏi!'
                countErr++
            } else {
                formMessageType.classList.add('d-none')
                formMessageType.textContent = ''
            }

            const radioGroupAnswer = e.querySelector('.correct-answer-radio:checked')
            if (!radioGroupAnswer) {
                formMessageAnswer.classList.remove('d-none')
                formMessageAnswer.textContent = 'Vui lòng thêm câu trả lời đúng!'
                countErr++
            } else {
                formMessageAnswer.classList.add('d-none')
                formMessageAnswer.textContent = ''
            }


        })

        return (countErr == 0)
    },
    start: function () {
        this.submitForm()
        this.handleEvent()
    }
}

app.start()
