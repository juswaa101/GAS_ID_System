<?php

use App\Http\Controllers\IDTemplateController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\SignaturePadController;
use Illuminate\Http\Request;
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

// Route::get('/', function (Request $request) {

//     return redirect('login');
// });

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('pdf', [PdfController::class, 'index']);

Route::get('/upload-id', [SignaturePadController::class, 'index']);
Route::get('/id-template', [IDTemplateController::class, 'getIDTemplate']);
Route::post('/upload-id', [SignaturePadController::class, 'upload'])->name('upload.store');

// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/upload-id', [SignaturePadController::class, 'index']);
//     Route::post('/upload-id', [SignaturePadController::class, 'upload'])->name('upload.store');
// });
