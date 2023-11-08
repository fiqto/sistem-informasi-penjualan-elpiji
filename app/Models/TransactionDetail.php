<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stock;
use App\Models\Transaction;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = "transaction_details";
    protected $fillable = [
        'id',
        'transaction_id',
        'stock_id',
        'quantity',
        'debt_quantity',
        'price',
        'created_at',
    ];

    public function stocks(){
    	return $this->belongsTo(Stock::class,'stock_id', 'id');
    }

    public function transactions(){
    	return $this->belongsTo(Transaction::class,'transaction_id', 'id');
    }

}
