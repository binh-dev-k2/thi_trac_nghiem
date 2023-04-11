<?php

namespace App\Http\Controllers;

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
        $exam = Exam::all();
        return view('listexam.index', compact('exam'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createStep1()
    {
        return view('exam.create');
    }


    public function storeStep1(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'count_participants' => 'required',
            'datetimes' => 'required',
            'time' => 'required',
        ]);

        $request->datetimes = explode(" - ", $request->datetimes);
        $start_time = $request->datetimes[0];
        $stop_time = $request->datetimes[1];

        $exam = Exam::firstOrCreate(
            [
                'user_id' => auth()->user()->id,
                'time' => $request->time,
                'name' => $request->name,
                'count_participants' => $request->count_participants,
                'start_time' => $start_time,
                'stop_time' => $stop_time,
            ],
            [
                'user_id' => auth()->user()->id,
                'time' => $request->time,
                'name' => $request->name,
                'count_participants' => $request->count_participants,
                'start_time' => $start_time,
                'stop_time' => $stop_time,
            ]
        );

        return redirect()->route('exam.create.2', ['id' => $exam->id]);
    }

    public function createStep2($id)
    {
        return view('exam.create2', compact('id'))->with(['status' => 'Tạo thông tin kì thi thành công!', 'type' => 'success']);
    }

    public function createStep3($id)
    {
        $exam = Exam::find($id);
        $easy = 0;
        $normal = 0;
        $hard = 0;

        foreach ($exam->question as $item) {
            $item->level == 1 ? $easy++ : $easy;
            $item->level == 2 ? $normal++ : $normal;
            $item->level == 3 ? $hard++ : $hard;
        }

        return view('exam.create3', compact('exam', 'easy', 'normal', 'hard'))->with(['status' => 'Tạo bài thi thành công!', 'type' => 'success']);
    }

    public function storeStep3(Request $request, $id)
    {
        $data = [
            'so_luong' => $request->so_luong,
            'cau_hoi_de' => $request->cau_hoi_de ?? 0,
            'cau_hoi_tb' => $request->cau_hoi_tb ?? 0,
            'cau_hoi_kho' => $request->cau_hoi_kho ?? 0,
            'diem_de' => $request->diem_de ?? 0,
            'diem_tb' => $request->diem_tb ?? 0,
            'diem_kho' => $request->diem_kho
        ];

        $exam = Exam::findOrFail($id);

        $easy = [];
        $normal = [];
        $hard = [];

        foreach ($exam->question as $item) {
            $item->level == 1 ? $easy[] = $item->id : '';
            $item->level == 2 ? $normal[] = $item->id : '';
            $item->level == 3 ? $hard[] = $item->id : '';
        }

        $exam->update([
            'matrix' => json_encode($data)
        ]);

        $randomKeys = [];

        for ($i = 1; $i <= $data['so_luong']; $i++) {
            $test = Test::firstOrCreate([
                'exam_id' => $exam->id,
                'slug' => $exam->id . "-" . $i
            ],
            [
                'exam_id' => $exam->id,
                'slug' => $exam->id . "-" . $i
            ]);

            $easyX = $easy;
            $normalX = $normal;
            $hardX = $hard;
            $easyY = $data['cau_hoi_de'];
            $normalY = $data['cau_hoi_tb'];
            $hardY = $data['cau_hoi_kho'];


            while ($easyY > 0) {
                $randomKey = array_rand($easyX);
                while (in_array($easyX[$randomKey], $randomKeys)) {
                    $randomKey = array_rand($easyX);
                }
                $randomKeys[] = $easyX[$randomKey];

                TestQuestion::create([
                    'test_id' => $test->id,
                    'question_id' => $easyX[$randomKey]
                ]);

                $easyY--;
            }

            while ($normalY > 0) {
                $randomKey = array_rand($normalX);
                while (in_array($normalX[$randomKey], $randomKeys)) {
                    $randomKey = array_rand($normalX);
                }
                $randomKeys[] = $normalX[$randomKey];

                TestQuestion::create([
                    'test_id' => $test->id,
                    'question_id' => $normalX[$randomKey]
                ]);

                $normalY--;
            }

            while ($hardY > 0) {
                $randomKey = array_rand($hardX);
                while (in_array($hardX[$randomKey], $randomKeys)) {
                    $randomKey = array_rand($hardX);
                }
                $randomKeys[] = $hardX[$randomKey];

                TestQuestion::create([
                    'test_id' => $test->id,
                    'question_id' => $hardX[$randomKey]
                ]);

                $hardY--;
            }
            $randomKeys = [];
        }

        return redirect()->route('home')->with(['status' => 'Tạo kì thi thành công!', 'type' => 'success']);
    }

    public function codeExam()
    {
        return view('doExam.insertCode');
    }

    public function doExam(Request $request)
    {
        $request->validate([
            'code_exam' => 'required'
        ]);
        $exam = Exam::where('id', $request->code_exam)->first();
        $now = Carbon::now();
        $start_time = Carbon::parse($exam->start_time);
        $stop_time = Carbon::parse($exam->stop_time);
        if ($exam == null) {
            return redirect()->back()->withErrors(['not_found' => "Không tìm thấy bài thi"]);
        }
        // Nếu bài thi đã đạt số lượng giới hạn
        if($exam->count_participanted >= $exam->count_participants) {
            $status = -2;
            return view('doExam.prepare', compact('exam', 'status'));
        }
        // Nếu đã làm bài
        $user = Auth::user();
        $test_exist = StudentTest::where('student_id', $user->id)->get();
        $check = false;
        foreach ($test_exist as $key => $value) {
            if ($value->test->exam->id == $exam->id) {
                $test_exist = $value;
                $check = true;
            }
        }

        if ($check) {
            if ($test_exist->scores != -1) { // Nếu bài thi đã được nộp

                return redirect()->route('exam.done', $test_exist->id);
            } else {
                // Kiểm tra xem còn thời gian làm không
                if ($now->between($start_time, $stop_time)) {
                    $status = 0;
                    return view('doExam.prepare', compact('exam', 'status'));
                } else {
                    // Nếu quá hạn làm bài hoặc chưa đến giờ làm bài
                   StudentTest::where('id', $test_exist->id)->update([
                    'scores' => 0
                   ]);
                   return redirect()->route('exam.done', $test_exist->id);
                }

            }
        }
        // Kiểm tra bài thi còn hạn làm không ?
        if ($now->between($start_time, $stop_time)) {
            $status = 0;
            return view('doExam.prepare', compact('exam', 'status'));
        } else {
            // Nếu quá hạn làm bài hoặc chưa đến giờ làm bài
            if ($now->greaterThan($stop_time)) {
                $status = 1;
                return view('doExam.prepare', compact('exam', 'status'));
            } else {
                $status = -1;
                return view('doExam.prepare', compact('exam', 'status'));
            }
        }

    }
    public function startExam(Store $session, $id)
    {
        $exam = Exam::where('id', $id)->first();
        // Nếu không có exam
        if ($exam == null) {
            return abort(404, 'Không tìm thấy trang')->view('errors.404');
        }
        $now = Carbon::now();
        $start_time = Carbon::parse($exam->start_time);
        $stop_time = Carbon::parse($exam->stop_time);
        // Nếu quá giờ làm bài
        if (!$now->between($start_time, $stop_time)) {
            if ($now->greaterThan($stop_time)) {
                $status = 1;
                return view('doExam.prepare', compact('exam', 'status'));
            } else {
                $status = -1;
                return view('doExam.prepare', compact('exam', 'status'));
            }
        }
        $user = Auth::user();
        $test_exist = StudentTest::where('student_id', $user->id)->get();

        // Kiểm tra xem đã làm bài thi đó chưa
        $check = false;
        foreach ($test_exist as $key => $value) {
            if ($value->test->exam->id == $id) {
                $test_exist = $value;
                $check = true;
            }
        }
        if ($check) {
            $time = $test_exist->test->exam->time * 60 - Carbon::now()->diffInSeconds($test_exist->created_at); // Tính thời gian làm bài còn lại
            if ($time < 0 || $test_exist->scores != -1) {
                return redirect()->route('exam.done', $test_exist->id);
            }
            return view('doExam.start', compact('test_exist', 'time'));

        } else {
            $exam = Exam::where('id', $id)->first();
            Exam::where('id', $id)->update([
                'count_participanted' => $exam->count_participanted += 1
            ]);
            $i = rand(0, count($exam->test) - 1);
            $test = $exam->test[$i];
            $test_exist = StudentTest::create([
                'student_id' => $user->id,
                'test_id' => $test->id,
                'scores' => -1,
            ]);
            if ($test_exist) {
                $time = $exam->time*60; // Tính thời gian làm bài còn lại
                return view('doExam.start', compact('test_exist', 'time'));
            }
        }


    }

    public function done($id)
    {
        $student_test = StudentTest::where('id', $id)->first();
        if ($student_test == null) {
            return abort(404, 'Không tìm thấy trang')->view('errors.404');
        }
        return view('doExam.done', compact('student_test'));
    }

    public function show(string $id)
    {
        $exam = Exam::where('id', $id)->first();
        return view('listexam.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit1(string $id)
    {
        $exam = Exam::where('id', $id)->first();
        return view('exam.edit', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update1(Request $request, string $id)
    {
        $validator = $request->validate([
            'name' => 'required',
            'count_participants' => 'required',
            'datetimes' => 'required',
            'time' => 'required',
        ]);

        $exam = Exam::find($id);

        if ($exam == null) {
            return abort(404, 'Không tìm thấy trang')->view('errors.404');
        }

        $request->datetimes = explode(" - ", $request->datetimes);
        $start_time = $request->datetimes[0];
        $stop_time = $request->datetimes[1];

        $exam->update([
            'user_id' => auth()->user()->id,
            'time' => $request->time,
            'name' => $request->name,
            'count_participants' => $request->count_participants,
            'start_time' => $start_time,
            'stop_time' => $stop_time,
        ]);

        return redirect()->route('exam.edit.2', ['id' => $exam->id]);
    }

    public function edit2(string $id)
    {
        $question = Question::where('exam_id', $id)->get();
        return view('exam.edit2', compact('id', 'question'))->with(['status' => 'Sửa thông tin kì thi thành công!', 'type' => 'success']);
    }

    public function edit3($id)
    {
        $exam = Exam::find($id);
        $easy = 0;
        $normal = 0;
        $hard = 0;

        foreach ($exam->question as $item) {
            $item->level == 1 ? $easy++ : $easy;
            $item->level == 2 ? $normal++ : $normal;
            $item->level == 3 ? $hard++ : $hard;
        }

        return view('exam.edit3', compact('exam', 'easy', 'normal', 'hard'))->with(['status' => 'Tạo bài thi thành công!', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Exam::destroy($id);

        return redirect()->route('exam.list')->with(['status' => 'Xóa kì thi thành công!', 'type' => 'success']);
    }
}
