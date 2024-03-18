<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FallbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
;


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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';

Route::prefix('blog')->group(function () {
    Route::get('/', [PostsController::class, 'index'])->name('blog.index');
    Route::get('/show/{id}', [PostsController::class, 'show'])->name('blog.show');
    Route::get('/create', [PostsController::class, 'create'])->name('blog.create');
    Route::post('/', [PostsController::class, 'store'])->name('blog.store');
    Route::get('/edit/{id}', [PostsController::class, 'edit'])->name('blog.edit');
    Route::patch('/update/{id}', [PostsController::class, 'update'])->name('blog.update');
    Route::delete('/{destroy/id}', [PostsController::class, 'destroy'])->name('blog.destroy');
});


Route::get('/', HomeController::class);

Route::fallback(FallbackController::class);