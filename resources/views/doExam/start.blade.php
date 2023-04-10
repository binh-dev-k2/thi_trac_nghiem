<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/v3.0.0/line.css') }}">
    <!-- Scripts -->

</head>
<style>
    .countdown {
        position: fixed;
        bottom: 120px;
        right: 10px;
        width: 100px;
        text-align: center;
        tab-size: 30px;
        padding: 5px;
        font-weight: 600;
        border-radius: 5px;
        z-index: 10
    }

    .no-select {
        -webkit-user-select: none;
        /* Safari */
        -moz-user-select: none;
        /* Firefox */
        -ms-user-select: none;
        /* IE10+/Edge */
        user-select: none;
    }
</style>

<body>
    <main class="main-content">
        <div class="admin">
            <div class="container-fluid">

                <div class="row justify-content-center">
                    <div class="countdown btn-warning" id="clock_exam">Time</div>
                    <div class="col-lg-8">
                        <div class="edit-profile">
                            <form class="card card-default card-md mb-4" id="form_data">
                                @csrf
                               
                                <div class="card-header text-center">
                                    <div class="col-6 ">
                                        <h4>Kì thi: {{ $test_exist->test->exam->name }}</h4>
                                        <p>Giáo viên: {{ $test_exist->test->exam->user->name }}</p>
                                    </div>
                                    <div class="col-6 text-center">
                                        <h4>Sinh viên: {{ Auth::user()->name }}</h4>
                                        <p>Thời gian: {{ $test_exist->test->exam->time }} phút</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @foreach ($test_exist->test->testQuestion as $key => $question)
                                    @php
                                    $choose_answer = -1;
                                        foreach ($test_exist->AnswerStudenTest as  $value) {
                                            if($value->question_id == $question->question->id) {
                                                $choose_answer = $value->answer_id;
                                            }
                                        }
                                         // Tính điểm câu hỏi  
                                         $matrix = json_decode($test_exist->test->exam->matrix);
                                        $diem = 0;
                                                if ($question->question->level == 1) {
                                                    $diem = $matrix->diem_de;
                                                } elseif ($question->question->level == 2) {
                                                    $diem =  $matrix->diem_tb;
                                                } else {
                                                    $diem =  $matrix->diem_kho;
                                                }
                                    @endphp
                                        <div class="">
                                            <h5 class="no-select">Câu {{ $key + 1 }}({{ $diem." điểm" }}):
                                                {{ $question->question->name }}</h5>
                                            <div class="radio-vertical-list">
                                                @foreach ($question->question->answer as $answer)
                                                    <div class="radio-theme-default custom-radio ">
                                                        <input class="radio" type="radio"
                                                            name="{{ $answer->question_id }}"
                                                            value="{{ $answer->id }}" id="{{ $answer->id }}" @if ($choose_answer == $answer->id) checked  @endif>
                                                        <label for="{{ $answer->id }}">
                                                            <span
                                                                class="radio-text no-select">{{ $answer->content }}</span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                                <input type="hidden" name="test_id" value="{{ $test_exist->id }}" id="">
                                <div class="d-flex justify-content-center mb-3">
                                    <button id="submit" class="btn btn-primary">Nộp bài</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- loader  -->
    <div id="overlayer">
        <div class="loader-overlay">
            <div class="dm-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
            </div>
        </div>
    </div>
    <!-- dark mode  -->
    <div class="enable-dark-mode dark-trigger">
        <ul>
            <li>
                <a href="#">
                    <i class="uil uil-moon"></i>
                </a>
            </li>
        </ul>
    </div>

    <script src="{{ asset('assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.min.js') }}"></script>
    <script>
        let clock = document.getElementById('clock_exam');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ route('api.exam.getTime', $test_exist->id) }}",
            success: function(data) {
                let totalSeconds = data.time;
                const intervalId = setInterval(() => {
                    const minutesRemaining = Math.floor(totalSeconds / 60);
                    const secondsRemaining = totalSeconds % 60;
                    clock.innerText = `${minutesRemaining} : ${secondsRemaining} `;
                    totalSeconds--;
                    if (totalSeconds < 0) {
                        clearInterval(intervalId);
                        let formdata = $('#form_data').serialize();
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            data: formdata,
                            url: "{{ route('api.exam.store') }}",
                            success: function(data) {
                                if (data.type == 'success') {
                                    $('#form_data').html( '<h1>Đã Nộp Bài </h1>');
                                    window.location.href = data.redirect
                                }
                            },

                        });
                    }
                }, 1000); // 1000 milliseconds = 1 second
            },
            error: function() {
                clearInterval(intervalId);
                let formdata = $('#form_data').serialize();
                $.ajax({

                    type: "POST",
                    dataType: "json",
                    data: formdata,
                    url: "{{ route('api.exam.store') }}",
                    success: function(data) {
                        if (data.type == 'success') {
                            $('#form_data').html( '<h1>Đã Nộp Bài </h1>');
                            window.location.href = data.redirect
                        }
                    },

                });
            }

        });


        // Nộp bài thi
        $('#submit').on('click', function(ev) {
            ev.preventDefault();
            let formdata = $('#form_data').serialize();
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formdata,
                url: "{{ route('api.exam.store') }}",
                success: function(data) {
                    if (data.type == 'success') {
                        $('#form_data').html( '<h1>Đã Nộp Bài </h1>');
                        window.location.href = data.redirect
                    }
                },


            });
        });
        //Lưu kết quả thi
        var test_id = {{ $test_exist->id }}
        var radio = document.querySelectorAll('.radio');
        radio.forEach(element => {
            element.addEventListener('click', function(ev) {
                let formdata = {
                    student_test_id: test_id,
                    question_id: element.getAttribute('name'),
                    answer_id: element.getAttribute('value')
                }
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: formdata,
                    url: "{{ route('api.exam.store.answer') }}",
                    success: function(data) {
                        if (data.type == 'success') {
                            console.log("Lưu thành công");
                        }
                    },


                });

            })
        });
    </script>
</body>

</html>
