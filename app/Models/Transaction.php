<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class Transaction extends Model
{
    use HasFactory, HasTimestamps;
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
        'created_at',
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
