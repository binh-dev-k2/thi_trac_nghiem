@extends('dashboard')
@section('head')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style>
        .gap>* {
            padding: 0 1rem;
        }
    </style>
@endsection


@section('content')
    <div class="contents">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">
                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">checkout</h4>
                            <div class="breadcrumb-action justify-content-center flex-wrap">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">checkout</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class=" checkout wizard6 global-shadow border-0 px-sm-50 px-20 pt-sm-50 py-30 mb-30 bg-white radius-xl w-100">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="checkout-progress-indicator content-center">
                            <div class="checkout-progress">
                                <div class="step current" id="1">
                                    <span><img class="svg" src="{{ asset('assets/img/svg/155-credit-card.svg') }}" alt=""> </span>
                                    <span>Thông tin kì thi</span>
                                </div>
                                <div class="current"><img src="{{ asset('assets/img/svg/checkout.svg') }}" alt="img" class="svg"></div>
                                <div class="step" id="2">
                                    <span><img class="svg" src="{{ asset('assets/img/svg/155-credit-card.svg') }}" alt=""></span>
                                    <span>Các câu hỏi</span>
                                </div>
                                <div class="current"><img src="{{ asset('assets/img/svg/checkout.svg') }}" alt="img" class="svg"></div>
                                <div class="step" id="3">
                                    <span><img class="svg" src="{{ asset('assets/img/svg/155-credit-card.svg') }}" alt=""></span>
                                    <span>Thiết lập bài thi</span>
                                </div>
                                <div class="current"><img src="{{ asset('assets/img/svg/checkout.svg') }}" alt="img" class="svg"></div>
                                <div class="step" id="4">
                                    <span><img class="svg" src="{{ asset('assets/img/svg/024-like.svg') }}" alt=""></span>
                                    <span>Hoàn thành</span>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col">
                                <div class="card checkout-shipping-form shadow-none border-0 shadow-none">
                                    <div class="card-header">
                                        <h4 class="fw-500">Tạo bài thi</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="edit-profile__body">
                                            <form id="form-create" action="#" method="POST">
                                                @csrf
                                                <div id="questions-container" class="row"></div>

                                                <button class="btn btn-primary btn-default btn-squared text-capitalize text-white" type="button"
                                                    id="add-question">Thêm câu hỏi</button>
                                                <div class=" d-flex pt-20 mb-20 justify-content-md-end justify-content-center">
                                                    <button type="submit" class="btn btn-primary btn-default btn-squared text-capitalize text-white">
                                                        Lưu & tiếp tục
                                                        <i class="ms-10 me-0 las la-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </form>

                                            <template id="question-template">
                                                <div class="question form-group query">
                                                    <div class="d-flex justify-content-between">
                                                        <label>Câu <span class="question-number"> </span>:</label>
                                                        <div class="d-flex flex-wrap align-items-center gap gx-4 gy-2">
                                                            <label>Độ khó:</label>
                                                            <div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input radio-difficult" type="radio" name="difficult" value="1">
                                                                    <label class="form-check-label">Dễ</label>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input radio-difficult" type="radio" name="difficult" value="2">
                                                                    <label class="form-check-label"">Trung bình</label>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="form-check"><input class="form-check-input radio-difficult" type="radio"
                                                                        name="difficult" value="3">
                                                                    <label class="form-check-label">Khó</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-11">
                                                            <div class="form-control-wrap">
                                                                <input class="form-control question-input" type="text" name="question" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-1">
                                                            <button type="button"
                                                                class="delete-question delete btn btn-danger btn-default btn-squared">Xóa</button>
                                                        </div>
                                                    </div>
                                                    <span class="form-message alert alert-danger d-none"></span></br>
                                                    <span>Câu trả lời:</span>
                                                    <span class="form-message alert alert-danger d-none"></span></br>
                                                    <div class="answers"></div>
                                                    <button type="button" class="add-answer btn btn-info btn-default btn-squared">Thêm câu
                                                        trả lời</button>
                                                </div>
                                            </template>

                                            <template id="answer-template">
                                                <div class="answer row mb-3 query">
                                                    <div class="col-11">
                                                        <div class="form-check row">
                                                            <input class="form-check-input correct-answer-radio" style="width: 1.5rem; height: 1.5rem"
                                                                type="radio" name="correct-answer">
                                                            <div class="form-control-wrap">
                                                                <input class="form-control answer-input" type="text" name="answer" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <button type="button" class="delete-answer delete btn btn-danger btn-default btn-squared">Xóa</button>
                                                    </div>
                                                    <span class="form-message alert alert-danger d-none"></span>
                                                </div>
                                            </template>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- <script src="{{ asset('assets/js/create_examp.js') }}"></script> --}}

    <script>
        const questionsContainer = document.getElementById('questions-container')
        const addQuestionBtn = document.getElementById('add-question')
        const formElement = document.getElementById('form-create')

        const app = {
            lengthAnswers: 4,
            lengthQuestions: 200,
            id: 0,
            submitForm: function() {
                const _this = this

                formElement.onsubmit = function(e) {
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

                        const token = '{{ csrf_token() }}'

                        $.ajax({
                            type: 'POST',
                            url: '{{ route('api.exam.store.2', $id) }}',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            data: JSON.stringify(values),
                            success: function(response) {
                                if (response.type == 'success') {
                                    window.location.href = response.redirect
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(status)
                                console.log(error)
                            }
                        });
                    }

                    return true
                }
            },
            handleEvent: function() {
                const _this = this;

                questionsContainer.addEventListener('click', function(event) {
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

                addQuestionBtn.addEventListener('click', function() {
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
            renderQuestionIndex: function() {
                questionsContainer.querySelectorAll('.question .question-number').forEach((e, index) => {
                    e.textContent = index + 1
                })
            },
            validate: function(elements) {
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
            validateRadio: function() {
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
            start: function() {
                this.submitForm()
                this.handleEvent()
            }
        }

        app.start()
    </script>
@endsection
