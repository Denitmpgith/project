<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fortDetiles extends Model
{
    use HasFactory;
    public function fortfolio()
    {
        return $this->belongsTo(fortfolio::class);
    }
}
