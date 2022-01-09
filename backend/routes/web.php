<?php
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

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'home'])->name('home');

Auth::routes();

Route::prefix('notes')->name('notes.')->group(function() {
    Route::middleware('auth')->group(function () {
        Route::get('/create', [NoteController::class, 'create'])->name('create');
        Route::post('/store', [NoteController::class, 'store'])->name('store');
        Route::delete('/{id}/destroy', [NoteController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/edit', [NoteController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [NoteController::class, 'update'])->name('update');
    });
    Route::get('/{id}', [NoteController::class, 'show'])->name('show');
});

// Todo：認証済ユーザーが自分のページだけ編集などできるようにルーティングを設定
Route::name('users.')->group(function() {
    Route::get('/{username}/edit', [UserController::class, 'edit'])->name('edit');
    Route::post('/{username}/update', [UserController::class, 'update'])->name('update');
    Route::get('/{username}', [UserController::class, 'show'])->name('show');
});


