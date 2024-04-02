<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function usages()
{
    return $this->hasMany(PromoCodeUsage::class, 'promo_code_id');
}
}
