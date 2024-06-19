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
    return view('layouts.post', [
        'title' => 'Home',
    ]);
});
// Route::get('/contact', function () {
//     return view('layouts.contact');
// });

Route::get('/', [MainController::class, 'index']);
Route::get('/post/{slug}', [MainController::class, 'show'])->name('post');
Route::get('/contact', [ContactController::class, 'index']);
