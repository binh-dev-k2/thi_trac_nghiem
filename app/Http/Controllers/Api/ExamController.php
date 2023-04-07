<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnswerStudentTest;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Test;
use App\Models\StudentTest;
use App\Models\TestQuestion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\Store;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ma_bai_thi = $request->test_id;
        $student_test =StudentTest::where('id', $ma_bai_thi)->first();
        $test = $student_test->test;
       if($student_test->scores == -1) { // Nếu chưa có điểm
            // Tính điểm bài thi
            $diem = 0;
            $matrix = json_decode($test->exam->matrix);
            foreach ($test->testQuestion as $question) {
                $dapAn_id = $request->get($question->question_id); // Lấy ra đáp án người dùng chọn
                foreach ($question->question->answer as $answer) {
                   
                    if ($answer->id == $dapAn_id) {
                        if ($answer->status == 1) {
                            if($question->question->level == 1) {
                                $diem = $diem + $matrix->diem_de;
                            }else  if($question->question->level == 2) {
                                $diem = $diem + $matrix->diem_tb;
                            }else {
                                $diem = $diem + $matrix->diem_kho;
                            }
                        }
                    }
                }
            }
            StudentTest::where('id', $ma_bai_thi)->update([
                'scores' => $diem
            ]
            );
        }
            return response()->json(['type' => 'success', 'redirect' => route('exam.done', $student_test->id)], 200);
    }

    public function storeStep2(Request $request, $id)
    {
        $data = json_decode($request->getContent(), true);

        foreach ($data as $ques) {
            $question = Question::firstOrCreate([
                'exam_id' => $id,
                'name' => $ques['question'],
                'level' => $ques['type']
            ],[
                'exam_id' => $id,
                'name' => $ques['question'],
                'level' => $ques['type']
            ]);

            foreach ($ques['answers'] as $key => $answer) {
                Answer::create([
                    'question_id' => $question->id,
                    'content' => $answer,
                    'status' => $key + 1 == $ques['correct-answer'] ? true : false
                ]);
            }
        }

        return response()->json(['type' => 'success', 'redirect' => route('exam.create.3', $id)], 200);
    }
    public function getTime($id)
    {
        $test_exist = StudentTest::where('id', $id)->first();
        $time = $test_exist->test->exam->time * 60 - Carbon::now()->diffInSeconds($test_exist->created_at); // Tính thời gian làm bài còn lại
        if($test_exist->scores != -1) {
            return response()->json(['type' => 'danger'],400);
        }
        return response()->json(['time' => $time]);
    }
    public function storeAnswer(Request $request)
    {
       
        $Answer = AnswerStudentTest::where('student_test_id', $request->student_test_id)->where('question_id',$request->question_id )->first();
        
        $result = false;
        if(isset($Answer->id)) {
            $result= AnswerStudentTest::where('id', $Answer->id)->update([
                'answer_id' =>$request->answer_id 
            ]);
        }else {
            $result = AnswerStudentTest::create([
                'student_test_id'=> $request->student_test_id,
                'question_id'=>$request->question_id ,
                'answer_id' =>$request->answer_id 
            ]);
        }
        if($result) {
            return response()->json(['type' => 'success']);
        }else {
            return response()->json(['type' => 'danger']);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
