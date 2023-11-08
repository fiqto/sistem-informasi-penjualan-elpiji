<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = "stocks";
    protected $fillable = [
        'id',
        'product_name',
        'stock',
        'purchase_price',
        'selling_price',
        'created_at',
        'updated_at',
    ];

    public function transaction_details(){
    	return $this->hasMany(TransactionDetail::class, 'id', 'stock_id');
    }

    public function stocks_versions(){
    	return $this->hasMany(StockVersions::class, 'id', 'product_id');
    }

    public function stock_opnames(){
    	return $this->hasMany(StockOpname::class, 'id', 'stock_id');
    }

}
