<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBalance extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'balance_amount', 'currency_code'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function withdraws()
    {
        return $this->hasMany(Withdraw::class, 'walletid', 'id');
    }
}
