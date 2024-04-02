<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $fillable = [
        'bank_name',
        'account_number',
        'account_title',
        'swift_code',
        'branch_code',
        'branch_name',
        'bank_address',
        'status',
    ];
}
