<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Models\StockVersions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->has('search')) {
            $keyword = $request->search;
            $stocks = Stock::where('product_name', 'like', "%$keyword%")
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $stocks = Stock::orderBy('id', 'desc')
            ->paginate(10);
        }

        return view('stock.table', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStockRequest $request)
    {
        //
        $data = $request->validated();
        $data['created_at'] = now();
        $data['stock'] = 0;
        DB::table('stocks')->insert($data);
        
        return redirect()->route('stocks.index')
            ->with('success', 'Berhasil DiTambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockRequest $request, Stock $stock)
    {
        //
        $this->saveStockVersion($stock);

        // return var_dump($request->validated());
        $stock->update($request->validated());
        
        
        return redirect()->route('stocks.index')
            ->with('success', 'Berhasil DiUpdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
        $hasStock = Transaction::where('stock_id', $stock->id)->exists();

        if ($hasStock) {
            return redirect()->route('stocks.index')
                ->with('error', 'Tidak dapat menghapus data karena memiliki keterhubungan dengan transaksi yang ada.');
        }

        $hasStockVersion = StockVersions::where('product_id', $stock->id)->get();

        $hasStockVersion->each->delete();

        $stock->delete();
        
        return redirect()->route('stocks.index')
            ->with('success', 'Berhasil Dihapus!');
    }

    private function saveStockVersion(Stock $stock)
    {
        StockVersions::create([
            'product_id' => $stock->id,
            'product_name' => $stock->product_name,
            'stock' => $stock->stock,
            'purchase_price' => $stock->purchase_price,
            'selling_price' => $stock->selling_price,
        ]);
    }
}
