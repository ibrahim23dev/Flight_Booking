<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyExchangeRate extends Model
{
    use HasFactory;
    protected $table = 'currency_exchange_rates';

    protected $fillable = ['currency_from', 'currency_to', 'exchange_rate', 'BDT_value'];
}
