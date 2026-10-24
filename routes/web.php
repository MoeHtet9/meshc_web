<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\FrontController::class,'signin'])->name('signin');
Route::get('/main', [App\Http\Controllers\FrontController::class,'main'])->name('main');
Route::get('/claim/{id}/{user_id}/{amount}', [App\Http\Controllers\FrontController::class,'claim'])->name('claim');

// DEPOSIT
Route::get('/deposit', [App\Http\Controllers\FrontController::class,'deposit'])->name('deposit');
Route::post('/new_deposit', [App\Http\Controllers\FrontController::class,'new_deposit'])->name('new_deposit');

// WITHDRAWAL
Route::get('/withdrawal', [App\Http\Controllers\FrontController::class,'withdrawal'])->name('withdrawal');
Route::post('/new_withdrawal', [App\Http\Controllers\FrontController::class,'new_withdrawal'])->name('new_withdrawal');

// HOLIDING
Route::get('/holiding', [App\Http\Controllers\FrontController::class,'holiding'])->name('holiding');
Route::post('/new_holiding', [App\Http\Controllers\FrontController::class,'new_holiding'])->name('new_holiding');

Route::get('/history', [App\Http\Controllers\FrontController::class,'history'])->name('history');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();