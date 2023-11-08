<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockVersions extends Model
{
    use HasFactory;

    protected $table = "stocks_versions";
    protected $fillable = [
        'id',
        'product_id',
        'product_name',
        'stock',
        'purchase_price',
        'selling_price',
        'created_at',
    ];

    public function stocks(){
    	return $this->belongsTo(Stock::class,'product_id', 'id');
    }
}
