<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentTest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class StudentTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $exam = StudentTest::where('student_id', $user->id)->get();
        return view('studenttest.index', compact('exam'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $studentTest = StudentTest::where('id', $id)->first();
        return view('studenttest.show',compact('studentTest'));
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
