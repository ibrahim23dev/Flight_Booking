<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsPrivacy extends Model
{
    use HasFactory;
    protected $table = 'terms_privacy';

    protected $fillable = [
        'title',
        'points',
    ];

    protected $casts = [
        'points' => 'array', // Cast the 'points' attribute as an array
    ];
}
