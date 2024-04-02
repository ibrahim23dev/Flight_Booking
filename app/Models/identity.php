<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class identity extends Model
{
    use HasFactory;
    protected $table = 'identity';

    protected $fillable = [
        'site_title',
        'logo_image',
    ];
}
