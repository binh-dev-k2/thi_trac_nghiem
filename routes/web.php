<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;

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

Route::prefix('bai-thi')->group(function () {
    Route::get('/tao-bai-thi/buoc-1', [ExamController::class, 'createStep1'])->name('exam.create.1');
    Route::post('/tao-bai-thi/buoc-1', [ExamController::class, 'storeStep1'])->name('exam.store.1');
    Route::get('/tao-bai-thi/buoc-2', [ExamController::class, 'createStep2'])->name('exam.create.2');
    Route::post('/tao-bai-thi/buoc-2', [ExamController::class, 'storeStep2'])->name('exam.store.2');

});

});

Auth::routes();

