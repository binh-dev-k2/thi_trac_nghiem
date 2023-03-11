<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\exam;

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
    public function create()
    {
        return view('exam.create');
    }
    public function createStep1(Request $request)
    {
       $validator = $request->insert([
            'name' => 'required',
            'count_participants' => 'required',
            'datetimes' => 'required',
           
       ]);
       $request->datetimes = explode("-",$request->datetimes);
       $start_time = strtotime($request->datetimes[0]);
       $stop_time = strtotime($request->datetimes[1]);
       $exam = exam::create([
            'name' => $request->name,
            'count_participants' => $request->count_participants,
            'start_time' => $start_time,
            'stop_time' => $stop_time,
       ]);
       return view('exam.createstep2', compact('data'));

       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
