<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\Stock;
use Carbon\Carbon;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Menampilkan Chart Penjualan
        $currentDate = Carbon::now()->format('Y-m-d');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $twoDaysAgo = Carbon::now()->subDays(2)->format('Y-m-d');
        $threeDaysAgo = Carbon::now()->subDays(3)->format('Y-m-d');
        $fourDaysAgo = Carbon::now()->subDays(4)->format('Y-m-d');
        $fiveDaysAgo = Carbon::now()->subDays(5)->format('Y-m-d');
        $sixDaysAgo = Carbon::now()->subDays(6)->format('Y-m-d');

        $totalYesterday = Transaction::where('transaction_type', '=', 'Penjualan')
                ->whereDate('transaction_date', $yesterday)
                ->sum('quantity');
        $totalTwoDaysAgo = Transaction::where('transaction_type', '=', 'Penjualan')
                ->whereDate('transaction_date', $twoDaysAgo)
                ->sum('quantity');
        $totalThreeDaysAgo = Transaction::where('transaction_type', '=', 'Penjualan')
                ->whereDate('transaction_date', $threeDaysAgo)
                ->sum('quantity');
        $totalFourDaysAgo = Transaction::where('transaction_type', '=', 'Penjualan')
                ->whereDate('transaction_date', $fourDaysAgo)
                ->sum('quantity');
        $totalFiveDaysAgo = Transaction::where('transaction_type', '=', 'Penjualan')
                ->whereDate('transaction_date', $fiveDaysAgo)
                ->sum('quantity');
        $totalSixDaysAgo = Transaction::where('transaction_type', '=', 'Penjualan')
                ->whereDate('transaction_date', $sixDaysAgo)
                ->sum('quantity');

        // Menghitung Jumlah Pendapatan Penjualan Elpiji Hari Ini
        $transactions = Transaction::where('transaction_type', '=', 'Penjualan')
                ->whereDate('transaction_date', $currentDate)
                ->get();

        $totalPendapatan = 0;
        foreach ($transactions as $transaction) {
                $totalPendapatan += $transaction->quantity * $transaction->price;
        }

        // Menghitung Jumlah Penjualan Elpiji Hari Ini
        $totalPenjualan = Transaction::where('transaction_type', '=', 'Penjualan')
                ->whereDate('transaction_date', $currentDate)
                ->sum('quantity');
        
        // Menghitung Jumlah Pelanggan
        $members = DB::table('members')
                ->count();

        // Menghitung Jumlah Pelanggan
        $users = DB::table('users')
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

        // dd($yesterday);

        return view('dashboard')
            
            ->with(['totalYesterday' => $totalYesterday])
            ->with(['totalTwoDaysAgo' => $totalTwoDaysAgo])
            ->with(['totalThreeDaysAgo' => $totalThreeDaysAgo])
            ->with(['totalFourDaysAgo' => $totalFourDaysAgo])
            ->with(['totalFiveDaysAgo' => $totalFiveDaysAgo])
            ->with(['totalSixDaysAgo' => $totalSixDaysAgo])

            ->with(['currentDate' => $currentDate])
            ->with(['yesterday' => $yesterday])
            ->with(['twoDaysAgo' => $twoDaysAgo])
            ->with(['threeDaysAgo' => $threeDaysAgo])
            ->with(['fourDaysAgo' => $fourDaysAgo])
            ->with(['fiveDaysAgo' => $fiveDaysAgo])
            ->with(['sixDaysAgo' => $sixDaysAgo])
        
            ->with(['totalPendapatan' => $totalPendapatan])
            ->with(['totalPenjualan' => $totalPenjualan])
            ->with(['members' => $members])
            ->with(['users' => $users])
            ->with(['statusLunas' => $statusLunas])
            ->with(['statusBelum' => $statusBelum])
            ->with(['stocks' => $stocks]);

    }

}
