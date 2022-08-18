<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SignupController;
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

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

// method 1
Route::resource('users', UserController::class)->middleware(['auth', 'admin']);

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

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('signup', [SignupController::class, 'index'])->name('signup');
Route::post('signup', [SignupController::class, 'signup']);
