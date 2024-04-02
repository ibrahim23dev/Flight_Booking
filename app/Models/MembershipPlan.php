<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $casts = [
        'id' => 'integer', // Remove any explicit casting for 'id'.
    ];
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
