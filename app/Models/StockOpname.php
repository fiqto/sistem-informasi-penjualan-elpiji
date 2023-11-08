<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    use HasFactory;
    protected $table = "stock_opnames";
    protected $fillable = [
        'id',
        'opname_code',
        'stock_id',
        'opname_date',
        'quantity_before',
        'quantity_after',
        'quantity_change',
        'opname_note',
        'created_at',
    ];

    public function stocks(){
    	return $this->belongsTo(Stock::class,'stock_id', 'id');
    }

}
