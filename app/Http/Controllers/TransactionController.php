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

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    public function purchase()
    {
        $transactions = Transaction::where('transaction_type', '=', 'Pembelian')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $members = Member::latest()->get();
        $stocks = Stock::latest()->get();

        return view('transaction.incoming', compact('transactions','members', 'stocks'));
    }

    public function selling()
    {
        $transactions = Transaction::where('transaction_type', '=', 'Penjualan')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $members = Member::latest()->get();
        $stocks = Stock::latest()->get();

        return view('transaction.outgoing', compact('transactions','members', 'stocks'));
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
        $transaction_type = $request->input('transaction_type');
        $start = (new DateTime($request->input('start')))->format('Y-m-d');
        $end = (new DateTime($request->input('end')))->format('Y-m-d');
        
        $transactions = Transaction::where('transaction_type', '=', $transaction_type)
            ->orderBy('id', 'desc')
            ->whereBetween('transaction_date',[$start, $end])
            ->get();
            
        $members = Member::all();
        $stocks = Stock::all();

        $total_transaksi = 0;
        foreach ($transactions as $transaction) {
            $total_transaksi += $transaction->quantity * $transaction->price;
        }

        $dompdf = new Dompdf();
        $html = view('transaction.pdf', compact('transactions', 'members', 'stocks', 'total_transaksi'))->render();

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
        
        $dompdf->stream('transaksi-penjualan.pdf');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {   
        
        $transactionType = $request->input('transaction_type');
        $quantity = $request->input('quantity');


        $data = $request->validated();

        $member_id = $request->input('member_id');
        $member = DB::table('members')->where('id', $member_id)->first();
        if ($member) {
            $data['member_name'] = $member->member_name;
            $data['member_phone_number'] = $member->phone_number;
            $data['member_address'] = $member->address;
        }

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

        $buy = DB::table('transactions')->where('transaction_type', '=', 'Pembelian')->sum('quantity');
        $sale = DB::table('transactions')->where('transaction_type', '=', 'Penjualan')->sum('quantity');
        $stock = $buy - $sale;

        $data = $request->validated();
        $member_id = $request->input('member_id');
        $member = DB::table('members')->where('id', $member_id)->first();

        if ($member) {
            $data['member_name'] = $member->member_name;
            $data['member_phone_number'] = $member->phone_number;
            $data['member_address'] = $member->address;
        }

        if ($transactionType == 'Pembelian') {
            
            $transaction->update($data);

            return redirect()->route('transactions.create')
                ->with('success', 'Berhasil DiTambahkan!');

        } else {

            if ($totalItem > $stock) {
                return redirect()->route('transactions.index')
                    ->with('error', 'Stok tabung tidak mencukupi');

            } else {
                $stockUpdate = $stock - $totalItem;
                
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

        if ($transactionType == 'Pembelian') {

            $transaction->delete();

            return redirect()->route('transactions.create')
                ->with('success', 'Berhasil Dihapus!');
        } else{

            $transaction->delete();
        
            return redirect()->route('transactions.index')
                ->with('success', 'Berhasil Dihapus!');
        }
    }

}
