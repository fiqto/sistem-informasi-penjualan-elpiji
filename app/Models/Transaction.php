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
        'transation_type',
        'member_id',
        'transation_date',
        'total_item',
        'total_price',
        'status',
        'order_notes',
    ];
    public function members(){
    	return $this->belongsTo(Member::class,'member_id', 'id');
    }

}
