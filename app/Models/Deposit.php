<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'date_of_deposit',
        'deposited_from',
        'mode',
        'deposited_bank',
        'branch',
        'city',
        'transaction_no',
        'status',
        'user_id',
        'remarks',
        'image',
    ];

    public function depositor()
    {
        return $this->belongsTo(User::class, 'deposited_from');
    }
    public function transections()
    {
        return $this->morphMany(Transection::class, 'releted');
    }
}
