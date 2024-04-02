<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $primaryKey = 'package_id';
    protected $guarded=[];
     // Define the relationships to the component tables

     public function packageCategory()
    {
        return $this->belongsTo(PackageCategory::class, 'package_category_id');
    }

     public function flights()
     {
         return $this->hasMany(Flight::class, 'package_id');
     }
 
     public function hotels()
     {
         return $this->hasMany(Hotel::class, 'package_id');
     }
 
     public function cars()
     {
         return $this->hasMany(Car::class, 'package_id');
     }

     public function tourBookings()
     {
         return $this->hasMany(TourBooking::class, 'package_id', 'package_id');
     }
}
