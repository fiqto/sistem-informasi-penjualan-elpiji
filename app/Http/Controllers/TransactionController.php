<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Member;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendEmailJob;
use App\Models\Stock;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    public function purchase(Request $request)
    {
        if ($request->has('search')) {
            $keyword = $request->search;
            $transactions = Transaction::where('transaction_type', '=', 'Pembelian')
                ->where(function ($query) use ($keyword) {
                    $query->where('member_name', 'like', "%$keyword%")
                        ->orWhere('status', 'like', "%$keyword%");
                })
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $transactions = Transaction::where('transaction_type', '=', 'Pembelian')
                ->orderBy('id', 'desc')
                ->paginate(10);
        }

        $members = Member::latest()->get();
        $stocks = Stock::latest()->get();

        return view('transaction.incoming', compact('transactions','members', 'stocks'));
    }

    public function selling(Request $request)
    {
        if ($request->has('search')) {
            $keyword = $request->search;
            $transactions = Transaction::where('transaction_type', '=', 'Penjualan')
                ->where(function ($query) use ($keyword) {
                    $query->where('member_name', 'like', "%$keyword%")
                        ->orWhere('status', 'like', "%$keyword%");
                })
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $transactions = Transaction::where('transaction_type', '=', 'Penjualan')
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
        
        $members = Member::latest()->get();
        $stocks = Stock::latest()->get();
        
        return view('transaction.outgoing', compact('transactions', 'members', 'stocks'));
        
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transactions = Transaction::latest()->get();
        $members = Member::latest()->get();
        $stocks = Stock::latest()->get();

        return view('transaction.create', compact('transactions','members','stocks'));
    }

    public function print(Request $request)
    {
        // dd($request->stock_id);
        $transaction_type = $request->input('transaction_type');
        $start = (new DateTime($request->input('start')))->format('Y-m-d');
        $end = (new DateTime($request->input('end')))->format('Y-m-d');
        $currentDate = Carbon::now()->format('Y-m-d');
        // $stock_id = $request->input('stock_id');
        
        // if ($stock_id == '0') {
        // $transactions = Transaction::where('transaction_type', $transaction_type)
        //     ->orderBy('id', 'desc')
        //     ->whereBetween('transaction_date',[$start, $end])
        //     ->get();
            
        // } else {
        // $transactions = Transaction::where('stock_id', $request->stock_id)
        //     ->orWhere('transaction_type', $transaction_type)
        //     ->orderBy('id', 'desc')
        //     ->whereBetween('transaction_date',[$start, $end])
        //     ->get();
        // }

        $transactions = Transaction::where('transaction_type', $transaction_type)
            ->orderBy('id', 'desc')
            ->whereBetween('transaction_date',[$start, $end])
            ->get();
            
        $members = Member::all();
        $stocks = Stock::all();

        $total_transaksi = 0;
        foreach ($transactions as $transaction) {
            $total_transaksi += $transaction->quantity * $transaction->price;
        }

        $total_pendapatan = 0;
        foreach ($transactions as $transaction) {
            $total_pendapatan += ($transaction->quantity * $transaction->price)-($transaction->quantity * $transaction->stocks->purchase_price);
        }

        $dompdf = new Dompdf();
        $html = view('transaction.pdf', compact('transactions', 'members', 'stocks', 'total_transaksi', 'transaction_type', 'total_pendapatan', 'currentDate'))->render();

        $dompdf->loadHtml($html);
        $dompdf->render();

        $dompdf->stream('laporan_transaksi.pdf', ['Attachment' => false]);
    }

    public function print_detail(Transaction $transaction)
    {
        $members = Member::all();
        $stocks = Stock::all();

        $dompdf = new Dompdf();
        $html = view('transaction.detailpdf', compact('transaction', 'members', 'stocks'))->render();
        
        $dompdf->loadHtml($html);
        $dompdf->render();
        
        $dompdf->stream('transaksi-penjualan.pdf', ['Attachment' => false]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {   
        
        $transactionType = $request->input('transaction_type');
        $quantity = $request->input('quantity');


        $data = $request->validated();

        $user = Auth::user();
        $data['user_id'] = $user->id;

        $stock_id = $request->input('stock_id');
        $stock = DB::table('stocks')->where('id', $stock_id)->first();
        

        if ($transactionType == 'Pembelian') {

            $total = $stock->stock + $quantity;
            DB::table('stocks')->where('id', $stock_id)->update(['stock' => $total]);
            
            DB::table('transactions')->insert($data);

            return redirect()->route('transactions.create')
                ->with('success', 'Berhasil DiTambahkan!');

        } else {

            if ($quantity > $stock->stock) {
                return redirect()->route('transactions.create')
                    ->with('error', 'Stok tabung tidak mencukupi');

            } else {
                $stockUpdate = $stock->stock - $quantity;
                
                if ($stockUpdate < 20) {
                    $details['email'] = 'pemilik@gmail.com';
                    dispatch(new SendEmailJob($details));

                    DB::table('stocks')->where('id', $stock_id)->update(['stock' => $stockUpdate]);
                    DB::table('transactions')->insert($data);
                
                    return redirect()->route('transactions.create')
                        ->with('success', 'Berhasil DiTambahkan!')
                        ->with('warning', 'Stok tabung hampir habis, segera isi ulang');

                } else {
                    DB::table('stocks')->where('id', $stock_id)->update(['stock' => $stockUpdate]);
                    DB::table('transactions')->insert($data);

                    return redirect()->route('transactions.create')->with('success', 'Berhasil Ditambahkan!');

                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $transactionType = $request->input('transaction_type');
        $totalItem = $request->input('quantity');

        $data = $request->validated();

        $stock_id = $request->input('stock_id');
        $stock = DB::table('stocks')->where('id', $stock_id)->first();
        

        if ($transactionType == 'Pembelian') {
            
            $transaction->update($data);

            return redirect()->route('transactions.create')
                ->with('success', 'Berhasil DiTambahkan!');

        } else {

            if ($totalItem > $stock->stock) {
                return redirect()->route('transactions.index')
                    ->with('error', 'Stok tabung tidak mencukupi');

            } else {
                $stockUpdate = $stock->stock - $totalItem;
                
                if ($stockUpdate < 20) {
                    $details['email'] = 'pemilik@gmail.com';
                    dispatch(new SendEmailJob($details));

                    $transaction->update($data);
                
                    return redirect()->route('transactions.index')
                        ->with('success', 'Berhasil DiTambahkan!')
                        ->with('warning', 'Stok tabung hampir habis, segera isi ulang');

                } else {
                    $transaction->update($data);
                
                    return redirect()->route('transactions.index')
                        ->with('success', 'Berhasil DiTambahkan!');
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
        $transactionType = $transaction->transaction_type;

        $stock_id = $transaction->stock_id;
        $stock = DB::table('stocks')->where('id', $stock_id)->first();

        if ($transactionType == 'Pembelian') {

            $total = $stock->stock - $transaction->quantity;
            DB::table('stocks')->where('id', $stock_id)->update(['stock' => $total]);

            $transaction->delete();

            return redirect()->route('transactions.purchase')
                ->with('success', 'Berhasil Dihapus!');
        } else{

            $total = $stock->stock + $transaction->quantity;
            DB::table('stocks')->where('id', $stock_id)->update(['stock' => $total]);

            $transaction->delete();
        
            return redirect()->route('transactions.selling')
                ->with('success', 'Berhasil Dihapus!');
        }
    }

}
