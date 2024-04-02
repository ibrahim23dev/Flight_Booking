<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'phone',
        'email',
        'social_media',
    ];

    protected $casts = [
        'social_media' => 'array',
    ];
}
