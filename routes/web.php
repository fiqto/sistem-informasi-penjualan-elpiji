<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;

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

Route::get('/', function () {
    return view('welcome');
});

// Sebagai Pegawai
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    // Route::get('/customer', [HomeController::class, 'customer'])->name('customer');
    Route::get('/account', [HomeController::class, 'account'])->name('account')->middleware('is_admin');
    
    Route::resource('members', MemberController::class);
    Route::resource('transactions', TransactionController::class);
    
});



