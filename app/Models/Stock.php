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

    public function transactions(){
    	return $this->hasMany(Transaction::class, 'id', 'stock_id');
    }

    public function stocks_versions(){
    	return $this->hasMany(StockVersions::class, 'id', 'product_id');
    }

}
