<?php

namespace App\Http\Controllers;

use App\Models\StockOpname;
use App\Http\Requests\StoreStockOpnameRequest;
use App\Http\Requests\UpdateStockOpnameRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class StockOpnameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->has('search')) {
            $keyword = $request->search;
            $stockOpname = StockOpname::where('opname_code', 'like', "%$keyword%")
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $stockOpname = StockOpname::orderBy('id', 'desc')
                ->paginate(10);
        }

        $stocks = Stock::latest()->get();
        
        return view('stock.opname', compact('stockOpname', 'stocks'));
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
    public function store(StoreStockOpnameRequest $request)
    {
        //
        $data = $request->validated();

        $stock_id = $request->input('stock_id');
        $stock = DB::table('stocks')->where('id', $stock_id)->first();

        $after = $request->input('quantity_after');
        $data['quantity_before'] = $stock->stock;
        $before = $data['quantity_before'];

        if( $after > $before){
            $data['quantity_change'] = $after - $before;
        } else {
            $data['quantity_change'] = $before - $after;
        }

        DB::table('stocks')->where('id', $stock_id)->update(['stock' => $after]);
        
        DB::table('stock_opnames')->insert($data);
        
        return redirect()->route('stock-opname.index')
            ->with('success', 'Berhasil DiTambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StockOpname $stockOpname)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockOpname $stockOpname)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockOpnameRequest $request, StockOpname $stockOpname)
    {
        //
        $data = $request->validated();

        $stock_id = $request->input('stock_id');
        $stock = DB::table('stocks')->where('id', $stock_id)->first();

        $after = $request->input('quantity_after');
        $data['quantity_before'] = $stockOpname->quantity_before;
        $before = $data['quantity_before'];

        if( $after > $before){
            $data['quantity_change'] = $after - $before;
            $now = $stock->stock - $stockOpname->quantity_change + $data['quantity_change'];
        } else {
            $data['quantity_change'] = $before - $after;
            $now = $stock->stock - $stockOpname->quantity_change + $data['quantity_change'];
        }

        DB::table('stocks')->where('id', $stock_id)->update(['stock' => $now]);

        $stockOpname->update($data);
        
        return redirect()->route('stock-opname.index')
            ->with('success', 'Berhasil DiUpdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockOpname $stockOpname)
    {
        //
        $stockOpname->delete();
        
        return redirect()->route('stock-opname.index')
            ->with('success', 'Berhasil Dihapus!');
    }
}
