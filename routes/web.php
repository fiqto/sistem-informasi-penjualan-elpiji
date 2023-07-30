<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use App\Models\Stock;

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
    return redirect()->route('dashboard');
})->name('welcome');

// Sebagai Pegawai
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    
    Route::resource('users', UserController::class)->middleware('is_admin');
    Route::resource('members', MemberController::class);

    Route::resource('transactions', TransactionController::class);
    Route::post('/cetak-pdf', [TransactionController::class, 'print'])->name('print');
    Route::get('/cetak-detail-pdf/{transaction}', [TransactionController::class, 'print_detail'])->name('print.detail');
    Route::get('/pembelian', [TransactionController::class, 'purchase'])->name('transactions.purchase');
    Route::get('/penjualan', [TransactionController::class, 'selling'])->name('transactions.selling');

    Route::resource('stocks', StockController::class);

    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->middleware(['is_admin'])
        ->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware(['is_admin']);

    Route::get('/api/stock/{id}', function ($id) {
        $stock = Stock::find($id);

        if ($stock) {
            $purchase_price = $stock->purchase_price;
            $selling_price = $stock->selling_price;
        } else {
            $purchase_price = null;
            $selling_price = null;
        }

        return response()->json([
            'purchase_price' => $purchase_price,
            'selling_price' => $selling_price
        ]);
    });
});



