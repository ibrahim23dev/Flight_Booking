<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    protected $primaryKey = 'withdraw_id';
    protected $table='withdraw';
    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userBalance()
    {
        return $this->belongsTo(UserBalance::class, 'walletid', 'id');
    }

    public function transections()
    {
        return $this->morphMany(Transection::class, 'releted');
    }
}
