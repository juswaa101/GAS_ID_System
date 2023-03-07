<?php

use App\Http\Controllers\SignaturePadController;
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

Route::get('/upload-id', [SignaturePadController::class, 'index']);
Route::post('/upload-id', [SignaturePadController::class, 'upload'])->name('upload.store');
