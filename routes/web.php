<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
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
//     return view('home');
// });

Route::get('/', [PostController::class, 'allPosts'])->name('home');
Route::get('/home', [PostController::class, 'allPosts'])->name('home');

// Route::get('/home', function () {
//     return view('home');
// })->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/post/index', [PostController::class, 'index'])->name('post.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/edit/{id}', [PostController::class, 'update'])->name('post.update');

    Route::delete('/post/edit/{id}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::get('/post/detail/{id}', [PostController::class, 'detail'])->name('post.detail');
    Route::get('/post/detail2/{id}', [PostController::class, 'detail2'])->name('post.detail2');
    Route::get('/home/{id}', [PostController::class, 'acceptance'])->name('post.acceptance');
    Route::get('/post/markAsComplete/{id}', [PostController::class, 'markAsComplete'])->name('post.markAsComplete');
    Route::get('/post/markAsComplete2/{id}', [PostController::class, 'markAsComplete2'])->name('post.markAsComplete2');

    Route::get('/post/ongoing2/{id}', [PostController::class, 'ongoing2'])->name('post.ongoing2');

    Route::get('/myposts', [PostController::class, 'myPosts'])->name('myposts');
    Route::get('/post/acceptanceDetails/{id}', [PostController::class, 'acceptanceDetails'])->name('post.acceptanceDetails');
    Route::get('/myaccepteds', [PostController::class, 'myAccepteds'])->name('myaccepteds');
});

require __DIR__ . '/auth.php';
