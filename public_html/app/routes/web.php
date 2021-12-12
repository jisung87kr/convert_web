<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConvertController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('convert.index');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('convert')->name('convert.')->group(function(){
    Route::get('/{type?}', [ConvertController::class, 'index'])->name('index');
    Route::post('/process/{type}', [ConvertController::class, 'process'])->name('process');
});

