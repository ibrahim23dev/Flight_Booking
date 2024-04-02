<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $primaryKey = 'hotel_id';
    protected $guarded=[];

    // Define the relationship to the Packages table
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
