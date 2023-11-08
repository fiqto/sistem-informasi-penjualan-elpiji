<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Member;
use App\Models\User;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendEmailJob;
use App\Models\Stock;
use App\Models\StockVersions;
use App\Models\TransactionDetail;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Date;

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
            $transactions = Transaction::where('transaction_code', 'like', "%PMB%")
                ->where(function ($query) use ($keyword) {
                    $query->whereHas('members', function ($query) use ($keyword) {
                        $query->where('member_name', 'like', "%$keyword%");
                    })
                    ->orWhere('status', 'like', "%$keyword%");
                })
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $transactions = Transaction::where('transaction_code', 'like', "%PMB%")
                ->orderBy('id', 'desc')
                ->paginate(10);
        }

        $members = Member::latest()->get();
        $stocks = Stock::latest()->get();
        $transactiondetails = TransactionDetail::latest()->get();

        return view('transaction.incoming', compact('transactions','members', 'stocks', 'transactiondetails'));
    }

    public function selling(Request $request)
    {
        if ($request->has('search')) {
            $keyword = $request->search;
            $transactions = Transaction::where('transaction_code', 'like', "%PNJ%")
                ->where(function ($query) use ($keyword) {
                    $query->whereHas('members', function ($query) use ($keyword) {
                        $query->where('member_name', 'like', "%$keyword%");
                    })
                    ->orWhere('status', 'like', "%$keyword%");
                })
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $transactions = Transaction::where('transaction_code', 'like', "%PNJ%")
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
        $transaction_code = $request->input('transaction_code');
        $start = (new DateTime($request->input('start')))->format('Y-m-d');
        $end = (new DateTime($request->input('end')))->format('Y-m-d');
        $currentDate = Carbon::now()->format('Y-m-d');

        $transactions = Transaction::where('transaction_code', $transaction_code)
            ->orderBy('id', 'desc')
            ->whereBetween('transaction_date',[$start, $end])
            ->get();
            
        $members = Member::all();
        $stocks = Stock::all();
        $stocks_versions = StockVersions::all();

        $firstPurchasePrice = 0;

        $total_elpiji = 0;
        foreach ($transactions as $transaction) {
            $total_elpiji += $transaction->quantity;
        }

        $total_transaksi = 0;
        foreach ($transactions as $transaction) {
            $total_transaksi += $transaction->quantity * $transaction->price;
        }
        
        $total_keuntungan = 0;

        $dompdf = new Dompdf();
        $html = view('transaction.pdf', compact('transactions', 'members', 'stocks', 'stocks_versions', 'firstPurchasePrice', 'total_transaksi', 'transaction_code', 'total_keuntungan', 'total_elpiji', 'start', 'end', 'currentDate'))->render();

        $dompdf->loadHtml($html);
        $dompdf->render();

        $dompdf->stream('laporan_transaksi.pdf', ['Attachment' => false]);
    }

    public function print_detail(Transaction $transaction)
    {
        $members = Member::all();
        $stocks = Stock::all();
        $transactiondetails = TransactionDetail::all();

        $dompdf = new Dompdf();
        $html = view('transaction.detailpdf', compact('transaction', 'members', 'stocks', 'transactiondetails'))->render();
        
        $dompdf->loadHtml($html);
        $dompdf->render();
        
        $dompdf->stream('transaksi-penjualan.pdf', ['Attachment' => false]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   

        $user = Auth::user();

        $transaction = Transaction::create([
            'transaction_code' => $request->input('transaction_code'),
            'user_id' => $user->id,
            'member_id' => $request->input('member_id'),
            'transaction_date' => $request->input('transaction_date'),
            'status' => "Lunas",
            'order_notes' => $request->input('order_notes'),
        ]);

        $details = $request->input('details');

        if (Str::startsWith($request->input('transaction_code'), 'PMB')) {
            foreach ($details as $detail) {
                $stock_id = $detail['stock_id'];
                $stock = DB::table('stocks')->where('id', $stock_id)->first();

                $transactiondetails = TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'stock_id' => $detail['stock_id'],
                    'quantity' => $detail['quantity'],
                    'debt_quantity' => $detail['debt_quantity'],
                    'price' => $detail['price'],
                ]);

                $total = $stock->stock + $detail['quantity'];
                DB::table('stocks')->where('id', $stock_id)->update(['stock' => $total]);
            }
            
            return redirect()->route('transactions.create')
                ->with('success', 'Berhasil DiTambahkan!');
        } else{
            DB::beginTransaction();

            try {
                foreach ($details as $detail) {
                    
                    $stock = DB::table('stocks')->lockForUpdate()->find($detail['stock_id']);

                    if (!$stock || $detail['quantity'] > $stock->stock) {
                        throw new \Exception('Stok tabung tidak mencukupi');
                    }

                    $stockUpdate = $stock->stock - $detail['quantity'];

                    TransactionDetail::create([
                        'transaction_id' => $transaction->id,
                        'stock_id' => $detail['stock_id'],
                        'quantity' => $detail['quantity'],
                        'debt_quantity' => $detail['debt_quantity'],
                        'price' => $detail['price'],
                    ]);

                    if ($stockUpdate < 20) {
                        $adminUsers = User::where('is_admin', 1)->get();
                        foreach ($adminUsers as $adminUser) {
                            $details['email'] = $adminUser->email;
                            dispatch(new SendEmailJob($details));
                        }
                    }

                    DB::table('stocks')->where('id', $detail['stock_id'])->update(['stock' => $stockUpdate]);
                }

                DB::commit();
                return redirect()->route('transactions.create')->with('success', 'Berhasil Ditambahkan!');

            } catch (\Exception $e) {

                DB::rollback();
                return redirect()->route('transactions.create')->with('error', 'Terjadi kesalahan saat menambahkan transaksi');

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
        $members = Member::latest()->get();
        $stocks = Stock::latest()->get();
        $transactiondetails = TransactionDetail::latest()->get();

        return view('transaction.detail', compact('transaction','members', 'stocks', 'transactiondetails'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {

        $transaction->update($request->validated());

        if (Str::startsWith($transaction->transaction_code, 'PMB')) {

            if($request->input('status') == 'Batal'){
                $transaction_detail = TransactionDetail::whereIn('transaction_id', [$transaction->id])
                    ->get();
                
                foreach ($transaction_detail as $detail) {
                    $stock_id = $detail->stock_id;
                    $stock = DB::table('stocks')->where('id', $stock_id)->first();
    
                    $stockAfter = $stock->stock - $detail->quantity;
    
                    DB::table('stocks')->where('id', $stock_id)->update(['stock' => $stockAfter]);
                }
            }

            return redirect()->route('transactions.purchase')
            ->with('success', 'Berhasil Disimpan!');
        } else {

            if($request->input('status') == 'Batal'){
                $transaction_detail = TransactionDetail::whereIn('transaction_id', [$transaction->id])
                    ->get();

                
                foreach ($transaction_detail as $detail) {
                    $stock_id = $detail->stock_id;
                    $stock = DB::table('stocks')->where('id', $stock_id)->first();
    
                    $stockAfter = $stock->stock + $detail->quantity;
    
                    DB::table('stocks')->where('id', $stock_id)->update(['stock' => $stockAfter]);
                }
            }

            return redirect()->route('transactions.selling')
            ->with('success', 'Berhasil Disimpan!');
        }
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
        $transactionType = $transaction->transaction_code;

        $stock_id = $transaction->stock_id;
        $stock = DB::table('stocks')->where('id', $stock_id)->first();

        if (Str::startsWith($transactionType, 'PMB')) {

            $total = $stock->stock - $transaction->quantity;

            if ($total < 0) {
                return redirect()->route('transactions.purchase')
                    ->with('error', 'Stok tabung tidak mencukupi');
            }
            
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
