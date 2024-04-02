<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    protected $fillable = [
        'departure_full',
        'departure_code',
        'arrival_full',
        'arrival_code',
        'departure_date',
        'return_date',
        'adult',
        'child',
        'infant',
        'travel_class',
        'name',
        'email',
        'mobile',
        'status',
        'view_by',
        'comment'
    ];
    public function viewedBy()
    {
        return $this->belongsTo(User::class, 'view_by');
    }
}
