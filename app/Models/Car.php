<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $primaryKey = 'car_id';
    protected $guarded=[];
    // Define the relationship to the Packages table
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
