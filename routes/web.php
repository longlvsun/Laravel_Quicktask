<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

// method 1
Route::resource('users', UserController::class);

// method 2
Route::prefix('notes')->name('notes.')->group(function() {
    Route::get('', [NoteController::class, 'index'])->name('index');
    Route::post('', [NoteController::class, 'store'])->name('store');
    Route::get('create', [NoteController::class, 'create'])->name('create');
    Route::get('{note}', [NoteController::class, 'show'])->name('show');
    Route::match(['PUT', 'PATCH'], '{note}', [NoteController::class, 'update'])
        ->name('update');
    Route::delete('{note}', [NoteController::class, 'destroy'])->name('destroy');
    Route::get('{note}/edit', [NoteController::class, 'edit'])->name('edit');
});
