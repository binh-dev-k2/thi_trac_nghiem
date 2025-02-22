<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExamController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/bai-thi/tao-bai-thi/b2-{id}', [ExamController::class, 'storeStep2'])->name('api.exam.store.2');
Route::post('/bai-thi/sua/b2-{id}', [ExamController::class, 'update2'])->name('api.exam.update.2');
Route::post('luu-ket-qua',[ExamController::class, 'store'])->name('api.exam.store');
Route::post('luu-cau-tra-loi',[ExamController::class, 'storeAnswer'])->name('api.exam.store.answer');
Route::get('lay-thoi-gian/{id}',[ExamController::class, 'getTime'])->name('api.exam.getTime');
