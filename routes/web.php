<?php

use App\Http\Controllers\homeController;
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
// Route::get('/', function () {
//     return view('login');
// })->name('login');

Route::get('/', [homeController::class, 'index']);
// Route::get('/{id}/{name}/{}', [homeController::class, 'index']);

Route::post('/', [homeController::class, 'importFile'])->name('csv.import');

Route::get('/pdf', [PdfController::class, 'index'])->name('generate.pdf');

Route::get('/id-template/{id}/{rfid}/{name}/{designate}', [IDTemplateController::class, 'getIDTemplate']);
Route::post('/id-template', [IDTemplateController::class, 'upload'])->name('upload.template');
