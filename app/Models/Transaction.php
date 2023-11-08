<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;
use App\Models\User;
use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class Transaction extends Model
{
    use HasFactory, HasTimestamps;
    protected $table = "transactions";
    protected $fillable = [
        'id',
        'transaction_code',
        'user_id',
        'member_id',
        'transaction_date',
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

    public function transaction_details(){
    	return $this->hasMany(TransactionDetail::class, 'id', 'transaction_id');
    }

}
