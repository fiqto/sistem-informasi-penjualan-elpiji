<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

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
    Route::get('/setting', [HomeController::class, 'setting'])->name('setting');
    
    Route::resource('users', UserController::class)->middleware('is_admin');
    Route::resource('members', MemberController::class);

    Route::resource('transactions', TransactionController::class);
    Route::post('/cetak-pdf', [TransactionController::class, 'print'])->name('print');
    Route::get('/cetak-detail-pdf', [TransactionController::class, 'print_detail'])->name('print.detail');
    Route::get('/pembelian', [TransactionController::class, 'purchase'])->name('transactions.purchase');
    Route::get('/penjualan', [TransactionController::class, 'selling'])->name('transactions.selling');

    Route::resource('stocks', StockController::class);
    
    Route::get('/search', function (Request $request) {
        $keyword = $request->search;
        $transaction_type = $request->transaction_type;
        $transactions = Transaction::where('member_name', 'like', "%".$keyword."%")
            ->where('transaction_type', '=', $transaction_type)
            ->orderBy('id', 'desc')
            ->paginate(10);

        $members = Member::latest()->get();

        return view('transaction.incoming', compact('transactions','members'));
    })->name('search');

});



