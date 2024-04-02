<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionsContent extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_type',
        'section_heading',
        'short_title',
        'section_content',
    ];
    protected $casts = [
        'section_content' => 'array',
    ];
}
