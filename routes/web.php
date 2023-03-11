<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['auth','verified'])->namespace('App\Http\Controllers')->group(function() {
Route::get('/', 'HomeController@index')->name('home');
// Tạo bài thi
Route::get('tao-bai-thi', 'ExamController@create')->name('exam.create');
Route::post('/', 'ExamController@createStep1')->name('create_step_1');
});

Auth::routes();
Route::resource('/exam', App\Http\Controllers\ExamController::class);