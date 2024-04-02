<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    use HasFactory;
    protected $table='payment_gateway';
    protected $fillable = [
        'identity',
        'agent',
        'public_key',
        'secret_key',
        'private_key',
        'shop_id',
        'status',
        'icon'
    ];
}
