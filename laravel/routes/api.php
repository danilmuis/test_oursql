<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MethodApiController;
use App\Http\Controllers\SubjectApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/methods', [MethodApiController::class, 'index']);
Route::post('/method', [MethodApiController::class, 'store']);
Route::put('/method/{id}', [MethodApiController::class, 'update']);
Route::delete('/method/{id}', [MethodApiController::class, 'destroy']);
Route::get('/restore/method/{id}', [MethodApiController::class, 'restore']);

Route::get('/subjects', [SubjectApiController::class, 'index'])->name('listSubject');
Route::post('/subject', [SubjectApiController::class, 'store']);
Route::put('/subject/{id}', [SubjectApiController::class, 'update']);
Route::delete('/subject/{id}', [SubjectApiController::class, 'destroy']);
Route::get('/restore/subject/{id}', [SubjectApiController::class, 'restore']);