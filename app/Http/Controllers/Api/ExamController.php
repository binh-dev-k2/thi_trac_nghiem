<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

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
        //
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
