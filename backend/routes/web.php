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
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/login/google/redirect', [GoogleLoginController::class, 'getGoogleAuth']);
Route::get('/login/google/callback', [GoogleLoginController::class, 'authGoogleCallback']);

Route::prefix('contact')->name('contact.')->group(function() {
    Route::get('/', [ContactController::class, 'contact'])->name('form');
    Route::post('/confirm', [ContactController::class, 'confirm'])->name('confirm');
    Route::post('/thanks', [ContactController::class, 'send'])->name('send');
});

Auth::routes();

Route::get('guest', [LoginController::class, 'guestLogin'])->name('login.guest');

Route::prefix('notes')->name('notes.')->group(function() {
    Route::middleware('auth')->group(function () {
        Route::get('/create', [NoteController::class, 'create'])->name('create');
        Route::post('/store', [NoteController::class, 'store'])->name('store');
        Route::delete('/{id}/destroy', [NoteController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/edit', [NoteController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [NoteController::class, 'update'])->name('update');
        Route::post('/{id}/bookmark', [NoteController::class, 'bookmark'])->name('bookmark');
    });
    Route::get('/', [NoteController::class, 'showAll'])->name('index');
    Route::get('/search', [NoteController::class, 'search'])->name('search');
    Route::get('/{id}', [NoteController::class, 'show'])->name('show');
});


Route::prefix('tags')->name('tags.')->group(function() {
    Route::get('/{id}', [TagController::class, 'showNotes'])->name('notes');
});


Route::name('users.')->group(function() {
    Route::middleware('auth')->group(function () {
        Route::get('/{username}/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('/{username}/update', [UserController::class, 'update'])->name('update');
        Route::get('/{username}/bookmarks', [UserController::class, 'showBookmarks'])->name('bookmarks');
    });
    Route::get('/{username}/notes', [UserController::class, 'showNotes'])->name('notes');
    Route::get('/{username}', [UserController::class, 'show'])->name('show');
});


