<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\TransactionDetail;
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

        $thisMonth = Carbon::now()->format('Y-m');
        $lastMonth = Carbon::now()->subMonth()->format('Y-m');
        $twoMonthsAgo = Carbon::now()->subMonths(2)->format('Y-m');
        $threeMonthsAgo = Carbon::now()->subMonths(3)->format('Y-m');
        $fourMonthsAgo = Carbon::now()->subMonths(4)->format('Y-m');
        $fiveMonthsAgo = Carbon::now()->subMonths(5)->format('Y-m');
        $sixMonthsAgo = Carbon::now()->subMonths(6)->format('Y-m');
        $sevenMonthsAgo = Carbon::now()->subMonths(7)->format('Y-m');
        $eightMonthsAgo = Carbon::now()->subMonths(8)->format('Y-m');
        $nineMonthsAgo = Carbon::now()->subMonths(9)->format('Y-m');
        $tenMonthsAgo = Carbon::now()->subMonths(10)->format('Y-m');
        $elevenMonthsAgo = Carbon::now()->subMonths(11)->format('Y-m');

        
        $transactionThisMonth = Transaction:: where('transaction_code', 'like', "%PNJ%")
                ->whereYear('transaction_date', Carbon::parse($thisMonth)->year)
                ->whereMonth('transaction_date', Carbon::parse($thisMonth)->month)
                ->get();

        $totalThisMonth = TransactionDetail::whereIn('transaction_id', $transactionThisMonth->pluck('id'))
                ->sum('quantity');
        
        $transactionLastMonth = Transaction::where('transaction_code', 'like', "%PNJ%")
                ->whereYear('transaction_date', Carbon::parse($lastMonth)->year)
                ->whereMonth('transaction_date', Carbon::parse($lastMonth)->month)
                ->get();

        $totalLastMonth = TransactionDetail::whereIn('transaction_id', $transactionLastMonth->pluck('id'))
                ->sum('quantity');

        $transactionTwoMonthsAgo = Transaction::where('transaction_code', 'like', "%PNJ%")
                ->whereYear('transaction_date', Carbon::parse($twoMonthsAgo)->year)
                ->whereMonth('transaction_date', Carbon::parse($twoMonthsAgo)->month)
                ->get();
        
        $totalTwoMonthsAgo = TransactionDetail::whereIn('transaction_id', $transactionTwoMonthsAgo->pluck('id'))
                ->sum('quantity');
        
        $transactionThreeMonthsAgo = Transaction::where('transaction_code', 'like', "%PNJ%")
                ->whereYear('transaction_date', Carbon::parse($threeMonthsAgo)->year)
                ->whereMonth('transaction_date', Carbon::parse($threeMonthsAgo)->month)
                ->get();

        $totalThreeMonthsAgo = TransactionDetail::whereIn('transaction_id', $transactionThreeMonthsAgo->pluck('id'))
                ->sum('quantity');

        $transactionFourMonthsAgo = Transaction::where('transaction_code', 'like', "%PNJ%")
                ->whereYear('transaction_date', Carbon::parse($fourMonthsAgo)->year)
                ->whereMonth('transaction_date', Carbon::parse($fourMonthsAgo)->month)
                ->get();

        $totalFourMonthsAgo = TransactionDetail::whereIn('transaction_id', $transactionFourMonthsAgo->pluck('id'))
                ->sum('quantity');

        $transactionFiveMonthsAgo = Transaction::where('transaction_code', 'like', "%PNJ%")
                ->whereYear('transaction_date', Carbon::parse($fiveMonthsAgo)->year)
                ->whereMonth('transaction_date', Carbon::parse($fiveMonthsAgo)->month)
                ->get();

        $totalFiveMonthsAgo = TransactionDetail::whereIn('transaction_id', $transactionFiveMonthsAgo->pluck('id'))
                ->sum('quantity');

        $transactionSixMonthsAgo = Transaction::where('transaction_code', 'like', "%PNJ%")
                ->whereYear('transaction_date', Carbon::parse($sixMonthsAgo)->year)
                ->whereMonth('transaction_date', Carbon::parse($sixMonthsAgo)->month)
                ->get();

        $totalSixMonthsAgo = TransactionDetail::whereIn('transaction_id', $transactionSixMonthsAgo->pluck('id'))
                ->sum('quantity');

        $transactionSevenMonthsAgo = Transaction::where('transaction_code', 'like', "%PNJ%")
                ->whereYear('transaction_date', Carbon::parse($sevenMonthsAgo)->year)
                ->whereMonth('transaction_date', Carbon::parse($sevenMonthsAgo)->month)
                ->get();

        $totalSevenMonthsAgo = TransactionDetail::whereIn('transaction_id', $transactionSevenMonthsAgo->pluck('id'))
                ->sum('quantity');

        $transactionEightMonthsAgo = Transaction::where('transaction_code', 'like', "%PNJ%")
                ->whereYear('transaction_date', Carbon::parse($eightMonthsAgo)->year)
                ->whereMonth('transaction_date', Carbon::parse($eightMonthsAgo)->month)
                ->get();

        $totalEightMonthsAgo = TransactionDetail::whereIn('transaction_id', $transactionEightMonthsAgo->pluck('id'))
                ->sum('quantity');

        $transactionNineMonthsAgo = Transaction::where('transaction_code', 'like', "%PNJ%")
                ->whereYear('transaction_date', Carbon::parse($nineMonthsAgo)->year)
                ->whereMonth('transaction_date', Carbon::parse($nineMonthsAgo)->month)
                ->get();

        $totalNineMonthsAgo = TransactionDetail::whereIn('transaction_id', $transactionNineMonthsAgo->pluck('id'))
                ->sum('quantity');

        $transactionTenMonthsAgo = Transaction::where('transaction_code', 'like', "%PNJ%")
                ->whereYear('transaction_date', Carbon::parse($tenMonthsAgo)->year)
                ->whereMonth('transaction_date', Carbon::parse($tenMonthsAgo)->month)
                ->get();

        $totalTenMonthsAgo = TransactionDetail::whereIn('transaction_id', $transactionTenMonthsAgo->pluck('id'))
                ->sum('quantity');
        
        $transactionElevenMonthsAgo = Transaction::where('transaction_code', 'like', "%PNJ%")
                ->whereYear('transaction_date', Carbon::parse($elevenMonthsAgo)->year)
                ->whereMonth('transaction_date', Carbon::parse($elevenMonthsAgo)->month)
                ->get();

        $totalElevenMonthsAgo = TransactionDetail::whereIn('transaction_id', $transactionElevenMonthsAgo->pluck('id'))
                ->sum('quantity');
        
        $transactionCurrentDate = Transaction::where('transaction_code', 'like', "%PNJ%")
                ->whereDate('transaction_date', $currentDate)
                ->get();

        $totalPendapatan = TransactionDetail::whereIn('transaction_id', $transactionCurrentDate->pluck('id'))
                ->get()
                ->sum(function ($transactionDetail) {
                    return $transactionDetail->quantity * $transactionDetail->price;
                });

        // $totalPendapatan = TransactionDetail::whereIn('transaction_id', $transactionCurrentDate->pluck('id'))
        //         ->sum('quantity');

        // Menghitung Jumlah Penjualan Elpiji Hari Ini
        $totalPenjualan = TransactionDetail::whereIn('transaction_id', $transactionCurrentDate->pluck('id'))
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

         // Tabel Transaksi Hutang
        $statusHutang = TransactionDetail::where('debt_quantity', '>', 0)
                ->orderBy('id', 'desc')
                ->paginate(5);

        return view('dashboard')
                ->with(['totalThisMonth' => $totalThisMonth])
                ->with(['totalLastMonth' => $totalLastMonth])
                ->with(['totalTwoMonthsAgo' => $totalTwoMonthsAgo])
                ->with(['totalThreeMonthsAgo' => $totalThreeMonthsAgo])
                ->with(['totalFourMonthsAgo' => $totalFourMonthsAgo])
                ->with(['totalFiveMonthsAgo' => $totalFiveMonthsAgo])
                ->with(['totalSixMonthsAgo' => $totalSixMonthsAgo])
                ->with(['totalSevenMonthsAgo' => $totalSevenMonthsAgo])
                ->with(['totalEightMonthsAgo' => $totalEightMonthsAgo])
                ->with(['totalNineMonthsAgo' => $totalNineMonthsAgo])
                ->with(['totalTenMonthsAgo' => $totalTenMonthsAgo])
                ->with(['totalElevenMonthsAgo' => $totalElevenMonthsAgo])

                ->with(['thisMonth' => $thisMonth])
                ->with(['lastMonth' => $lastMonth])
                ->with(['twoMonthsAgo' => $twoMonthsAgo])
                ->with(['threeMonthsAgo' => $threeMonthsAgo])
                ->with(['fourMonthsAgo' => $fourMonthsAgo])
                ->with(['fiveMonthsAgo' => $fiveMonthsAgo])
                ->with(['sixMonthsAgo' => $sixMonthsAgo])
                ->with(['sevenMonthsAgo' => $sevenMonthsAgo])
                ->with(['eightMonthsAgo' => $eightMonthsAgo])
                ->with(['nineMonthsAgo' => $nineMonthsAgo])
                ->with(['tenMonthsAgo' => $tenMonthsAgo])
                ->with(['elevenMonthsAgo' => $elevenMonthsAgo])
                
                ->with(['currentDate' => $currentDate])
                ->with(['totalPendapatan' => $totalPendapatan])
                ->with(['totalPenjualan' => $totalPenjualan])
                ->with(['members' => $members])
                ->with(['users' => $users])
                ->with(['statusHutang' => $statusHutang])
                ->with(['stocks' => $stocks]);

    }

}
