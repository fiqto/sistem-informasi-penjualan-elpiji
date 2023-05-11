<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Member extends Model
{
    use HasFactory;
    protected $table = "members";
    protected $fillable = [
        'id',
        'member_name',
        'phone_number',
        'address',
    ];

    public function transactions(){
    	return $this->hasMany(Transaction::class, 'id', 'member_id');
    }
}
