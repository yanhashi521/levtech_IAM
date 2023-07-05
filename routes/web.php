<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['middleware' => ['auth']], function(){
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/posts/create',  [PostController::class, 'create']);
    Route::post('/posts',  [PostController::class, 'store']);
    Route::get('/posts/{post}',  [PostController::class, 'show']);
    Route::put('/posts/{post}',  [PostController::class, 'update']);
    Route::delete('/posts/{post}',  [PostController::class, 'delete']);
    Route::get('/posts/{post}/edit',  [PostController::class, 'edit']);
    Route::get('category/{categories}', [CategoryController::class, 'index']);
});



require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
