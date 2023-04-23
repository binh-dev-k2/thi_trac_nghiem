<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\StudentTestController;

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

    Route::prefix('bai-thi')->middleware('isTeacher')->group(function () {
        Route::get('/tao-bai-thi', [ExamController::class, 'createStep1'])->name('exam.create.1');
        Route::post('/tao-bai-thi', [ExamController::class, 'storeStep1'])->name('exam.store.1');
        Route::get('/tao-bai-thi/b2-{id}', [ExamController::class, 'createStep2'])->name('exam.create.2');
        Route::get('/tao-bai-thi/b3-{id}', [ExamController::class, 'createStep3'])->name('exam.create.3');
        Route::post('/tao-bai-thi/b3-{id}', [ExamController::class, 'storeStep3'])->name('exam.store.3');

       

    });
    Route::prefix('lam-bai')->group(function ()
    {
        Route::get('/nhap-ma-bai-thi',[ExamController::class, 'codeExam'])->name('exam.code');
        Route::post('/lam-bai', [ExamController::class, 'doExam'])->name('exam.do');
        Route::get('/vao-thi/{id}', [ExamController::class, 'startExam'])->name('exam.start');
        Route::get('hoan-thanh/{id}',[ExamController::class, 'done'])->name('exam.done');
    });
    // Danh sách kì thi
    Route::prefix('danh-sach-ki-thi')->middleware('isTeacher')->group(function ()
    {
        Route::get('/', [ExamController::class, 'index'])->name('exam.list');
        Route::get('/xem-chi-tiet/{id}', [ExamController::class, 'show'])->name('exam.show');

        Route::get('/sua-b1/{id}', [ExamController::class, 'edit1'])->name('exam.edit.1');
        Route::put('/sua-b1/{id}', [ExamController::class, 'update1'])->name('exam.update.1');
        Route::get('/sua-b2/{id}', [ExamController::class, 'edit2'])->name('exam.edit.2');
        Route::get('/sua-b3/{id}', [ExamController::class, 'edit3'])->name('exam.edit.3');
        Route::post('/sua-b3/{id}', [ExamController::class, 'update3'])->name('exam.update.3');

        Route::get('/xem-bai-thi/{id}', [StudentTestController::class, 'show'])->name('test.show');

        Route::delete('/xoa/{id}', [ExamController::class, 'destroy'])->name('exam.delete');
    });
    // Danh sách bài thi đã làm của học sinh
    Route::prefix('danh-sach-bai-thi')->group(function () {
        Route::get('/',[StudentTestController::class,'index'])->name('studentTest.index');
        Route::get('/xem-bai/{id}', [StudentTestController::class, 'show'])->name('studentTest.show');
    });

});

Auth::routes();

