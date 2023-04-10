@extends('dashboard')
@section('content')
    <div class="contents">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mb-30">
                    <div class="card mt-30">
                        <div class="card-body">
                            <div class="col-12 row">

                                <h3>Thông tin bài thi</h3>
                                <div class="row mt-2 text-center">
                                    <div class="col-6 ">
                                        <h4>Kì thi: {{ $studentTest->test->exam->name }}</h4>
                                        <p>Giáo viên: {{ $studentTest->test->exam->user->name }}</p>
                                    </div>
                                    <div class="col-6 text-center">
                                        <h4>Sinh viên: {{ $studentTest->student->name }}</h4>
                                        <p>Ngày làm bài: {{ $studentTest->created_at }}</p>
                                        <h1 class="text-danger">{{ $studentTest->scores }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @foreach ($studentTest->test->testQuestion as $key => $question)
                                    @php
                                        $choose_answer = -1;
                                        foreach ($studentTest->AnswerStudenTest as $value) {
                                            if ($value->question_id == $question->question->id) {
                                                $choose_answer = $value->answer_id;
                                            }
                                        }
                                        
                                       
                                        // Tính điểm câu hỏi  
                                        $matrix = json_decode($studentTest->test->exam->matrix);
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
                                        <h5 class="no-select">Câu {{ $key + 1 }} ({{ $diem." điểm" }}):
                                            {{ $question->question->name }} </h5>
                                        <div class="radio-vertical-list">
                                            @foreach ($question->question->answer as $answer)
                                                <div class="radio-theme-default custom-radio ">
                                                    <input class="radio" type="radio" disabled
                                                        name="{{ $answer->question_id }}" value="{{ $answer->id }}"
                                                        id="{{ $answer->id }}"
                                                        @if ($choose_answer == $answer->id) checked @endif>
                                                    <label for="{{ $answer->id }}">
                                                        <span class="radio-text no-select">{{ $answer->content }}</span>
                                                    </label>
                                                    @if ($choose_answer == $answer->id)
                                                        @if ($answer->status == 1)
                                                            <span class="dm-tag tag-success tag-transparented">Đúng</span>
                                                        @else
                                                            <span class="dm-tag tag-danger tag-transparented">Sai</span>
                                                        @endif
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
