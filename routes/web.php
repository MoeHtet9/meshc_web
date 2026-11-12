<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\FrontController::class,'signin'])->name('signin');
Route::get('/main', [App\Http\Controllers\FrontController::class,'main'])->name('main');

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

//ADMIN
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/user', [App\Http\Controllers\AdminController::class, 'user'])->name('user');
    Route::get('/transaction', [App\Http\Controllers\AdminController::class, 'transaction'])->name('transaction');
    Route::get('/deposit_comp/{id}/{user_id}', [App\Http\Controllers\AdminController::class, 'deposit_comp'])->name('deposit.comp');
    Route::get('/deposit_fail/{id}/{user_id}', [App\Http\Controllers\AdminController::class, 'deposit_fail'])->name('deposit.fail');
    Route::get('/withdrawal_comp/{id}/{user_id}', [App\Http\Controllers\AdminController::class, 'withdrawal_comp'])->name('withdrawal.comp');
    Route::get('/withdrawal_fail/{id}/{user_id}', [App\Http\Controllers\AdminController::class, 'withdrawal_fail'])->name('withdrawal.fail');
});

// Verify OTP
Route::post('/verify-otp', [LoginController::class, 'verifyOtp'])->name('otp.verify');
