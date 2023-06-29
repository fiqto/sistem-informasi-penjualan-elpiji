<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\Stock;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Menghitung Total Stok
        $totalPembelian = DB::table('transactions')
                ->where('transaction_type', '=', 'Pembelian')
                ->sum('quantity');

        $totalPenjualan = DB::table('transactions')
                ->where('transaction_type', '=', 'Penjualan')
                ->sum('quantity');

        $totalStok = $totalPembelian - $totalPenjualan;

        // Menghitung Pendapatan
        $totalPenjualan = DB::table('transactions')
                ->where('transaction_type', '=', 'Penjualan')
                ->sum('price');
        
        // Menghitung Status Belum Lunas
        $statusBelumLunas = DB::table('transactions')
                ->where('status', '=', 'Belum Lunas')
                ->count();

        // Tabel Stok
        $stocks = Stock::orderBy('id', 'desc')
                ->paginate(10);

        // Tabel Transaksi Lunas
        $statusLunas = Transaction::where('status', '=', 'Lunas')
                ->paginate(5);

         // Tabel Transaksi Lunas
         $statusBelum = Transaction::where('status', '=', 'Belum Lunas')
                ->paginate(5);

        return view('dashboard')
            ->with(['totalStok' => $totalStok])
            ->with(['totalPenjualan' => $totalPenjualan])
            ->with(['statusBelumLunas' => $statusBelumLunas])
            ->with(['statusLunas' => $statusLunas])
            ->with(['statusBelum' => $statusBelum])
            ->with(['stocks' => $stocks]);

    }

    public function setting(){
        return view('setting.table');
    }

}
