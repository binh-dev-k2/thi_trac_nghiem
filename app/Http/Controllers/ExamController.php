<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
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
        ]);

        $request->datetimes = explode(" - ",$request->datetimes);
        $start_time = $request->datetimes[0];
        $stop_time = $request->datetimes[1];

        $exam = Exam::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'count_participants' => $request->count_participants,
            'start_time' => $start_time,
            'stop_time' => $stop_time,
        ]);

        $id = $exam->id;

        return view('exam.create2', compact('id'))->with(['status' => 'Tạo thông tin kì thi thành công!', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     */
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
