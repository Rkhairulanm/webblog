<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MainController;

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


Route::get('/test', function () {
    return view('layouts.category', [
        'title' => 'Home',
    ]);
});
// Route::get('/contact', function () {
//     return view('layouts.contact');
// });

Route::get('/', [MainController::class, 'index']);
Route::get('/post-{slug}', [MainController::class, 'show'])->name('post');
Route::get('/category-all', [MainController::class, 'categoryall'])->name('post');
Route::get('/category-{slug}', [MainController::class, 'category'])->name('post');
Route::get('/tag-{name}', [MainController::class, 'tag'])->name('post');
Route::get('/taglist', [MainController::class, 'taglist']);
Route::get('/search', [MainController::class, 'search']);
Route::get('/contact', [ContactController::class, 'index']);
