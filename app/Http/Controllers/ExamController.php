<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Test;
use App\Models\TestQuestion;
use Carbon\Carbon;

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

        $request->datetimes = explode(" - ",$request->datetimes);
        $start_time = $request->datetimes[0];
        $stop_time = $request->datetimes[1];

        $exam = Exam::firstOrCreate([
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
        ]);

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
            $item->level == 1 ? $easy ++ : $easy;
            $item->level == 2 ? $normal ++ : $normal;
            $item->level == 3 ? $hard ++ : $hard;
        }

        return view('exam.create3', compact('exam', 'easy', 'normal', 'hard'))->with(['status' => 'Tạo bài thi thành công!', 'type' => 'success']);
    }

    public function storeStep3(Request $request, $id) {
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
            $item->level == 1 ? $easy[] =  $item->id : '';
            $item->level == 2 ? $normal[] =  $item->id : '';
            $item->level == 3 ? $hard[] =  $item->id : '';
        }

        $exam->update([
            'matrix' => json_encode($data)
        ]);

        $randomKeys = [];

        for ($i=1; $i <= $data['so_luong']; $i++) {
            $test = Test::firstOrCreate([
                'exam_id' => $exam->id,
                'slug' => $exam->id . "-" . $i
            ], [
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
                while (in_array($randomKey, $randomKeys)) {
                    $randomKey = array_rand($easyX);
                }
                $randomKeys[] = $easyX[$randomKey];

                TestQuestion::create([
                    'test_id' => $test->id,
                    'question_id' => $easyX[$randomKey]
                ]);

                $easyY --;
            }

            while ($normalY > 0) {
                $randomKey = array_rand($normalX);
                while (in_array($randomKey, $randomKeys)) {
                    $randomKey = array_rand($normalX);
                }
                $randomKeys[] = $normalX[$randomKey];

                TestQuestion::create([
                    'test_id' => $test->id,
                    'question_id' => $normalX[$randomKey]
                ]);

                $normalY --;
            }

            while ($hardY > 0) {
                $randomKey = array_rand($hardX);
                while (in_array($randomKey, $randomKeys)) {
                    $randomKey = array_rand($hardX);
                }
                $randomKeys[] = $hardX[$randomKey];

                TestQuestion::create([
                    'test_id' => $test->id,
                    'question_id' => $hardX[$randomKey]
                ]);

                $hardY --;
            }

            $randomKeys = [];
        }

        return redirect()->route('home')->with(['status' => 'Tạo kì thi thành công!', 'type' => 'success']);
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
