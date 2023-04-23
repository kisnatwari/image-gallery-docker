<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Barryvdh\Debugbar\Facades\Debugbar;

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

Route::get('/', [PostController::class, 'index'])->name("/");

Route::get('/dashboard', [PostController::class, 'myPost'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource("posts", PostController::class);
Route::resource("comments", CommentController::class);

Route::get("/trash", [PostController::class, 'showTrash'])->middleware(['auth', 'verified'])->name('trash');
Route::get("/posts/forceDelete/{id}", [PostController::class, 'forceDelete'])->middleware(['auth', 'verified'])->name('posts.forceDelete');
Route::get("/posts/restore/{id}", [PostController::class, 'restore'])->middleware(['auth', 'verified'])->name('posts.restore');

require __DIR__ . '/auth.php';
