<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrelloController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MyNewMoviesController;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('selectApi');
    });
    Route::get('/select-api', function () {
        return view('auth.selectApi');
    })->name('selectApi');

    Route::get('/boards', [TrelloController::class, 'getBoards'])->name('boards.show');
    Route::get('/cards/create/{boardId}', [TrelloController::class, 'showCreateCardForm'])->name('cards.create');
    Route::post('/cards', [TrelloController::class, 'storeCard'])->name('cards.store');
    Route::get('/cards/{id}/edit', [TrelloController::class, 'edit'])->name('cards.edit');
    Route::put('/cards/{id}', [TrelloController::class, 'update'])->name('cards.update');
    Route::get('/cards/{boardId}', [TrelloController::class, 'index'])->name('cards.index');

    Route::get('/tvshows', [MyNewMoviesController::class, 'indexS'])->name('tvshows.index');
    Route::get('/movies', [MyNewMoviesController::class, 'indexM'])->name('movies.index');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login/google', [AuthController::class, 'redirectToGoogle'])->name('redirectToGoogle');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
