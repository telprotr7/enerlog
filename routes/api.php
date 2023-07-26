<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcController;

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

Route::get('/ac/get-data-ac', [AcController::class, 'getDataAc']);
Route::get('/ac/get-data-ac/{id}/detail', [AcController::class, 'getDataAcDetails']);
Route::get('/ac/get-data-ac/{id}/delete', [AcController::class, 'AcDelete']);
Route::post('/ac/get-data-ac/update/{id}', [AcController::class, 'AcUpdate']);

