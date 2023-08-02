<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\API\SupportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('/supports',  SupportController::class);



Route::get('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/register-user', [AuthController::class, 'register']);
    Route::get('/get-documents', [DocumentController::class, 'get_documents']);
    Route::post('/send-document', [DocumentController::class, 'send_document']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
