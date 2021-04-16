<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyController;

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

Route::post('/dummy', [DummyController::class, 'store'])->name('addDummy');
Route::post('/dummy/{id}', [DummyController::class, 'update'])->name('editDummy');
Route::get('/dummy/{id}', [DummyController::class, 'destroy'])->name('deleteDummy');
