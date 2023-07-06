<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";
    protected $fillable = [
        'id',
        'transaction_type',
        'user_id',
        'member_id',
        'stock_id',
        'transaction_date',
        'quantity',
        'price',
        'status',
        'order_notes',
    ];

    public function users(){
    	return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function members(){
    	return $this->belongsTo(Member::class,'member_id', 'id');
    }

    public function stocks(){
    	return $this->belongsTo(Stock::class,'stock_id', 'id');
    }

}
