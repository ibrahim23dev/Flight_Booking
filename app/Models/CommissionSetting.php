<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionSetting extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
