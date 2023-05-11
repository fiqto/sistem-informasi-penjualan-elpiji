<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                ->where('transation_type', '=', 'Pembelian')
                ->sum('total_item');

        $totalPenjualan = DB::table('transactions')
                ->where('transation_type', '=', 'Penjualan')
                ->sum('total_item');

        $totalStok = $totalPembelian - $totalPenjualan;

        // Menghitung Pendapatan
        $totalPenjualan = DB::table('transactions')
                ->where('transation_type', '=', 'Penjualan')
                ->sum('total_price');
        
        // Menghitung Status Belum Lunas
        $statusBelumLunas = DB::table('transactions')
                ->where('status', '=', 'Belum Lunas')
                ->count();
        
        // Menghitung Status Proses
        $statusProses = DB::table('transactions')
                ->where('status', '=', 'Proses')
                ->count();

        return view('adminHome')
            ->with(['totalStok' => $totalStok])
            ->with(['totalPenjualan' => $totalPenjualan])
            ->with(['statusBelumLunas' => $statusBelumLunas])
            ->with(['statusProses' => $statusProses]);

    }

}
