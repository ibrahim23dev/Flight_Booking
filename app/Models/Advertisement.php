<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    protected $fillable = [
        'created_by', 'name', 'position', 'status', 'link', 'description', 'image',
    ];

        // Define the relationship between Advertisement and User
        public function createdByUser()
        {
            return $this->belongsTo(User::class, 'created_by');
        }

        
}
